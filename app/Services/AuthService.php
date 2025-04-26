<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWK;

class AuthService
{
    private $appName = 'Quran-city';

    /**
     * @throws ServiceException
     */
    public function auth(array $data)
    {
        $email = $this->validateSSO($data);
        if ($data['email'] == "") {
            $data['email'] = $email;
        }
        $user = User::where('email', $data['email'])->first();

        if ($data['sso'] == 'self') {
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['token']])) {
                Auth::login($user);
            } else {
                throw new ServiceException("Username and password not correct");
            }
        } else {
            if ($user == null) {
                return $this->register($data);
            }
            Auth::login($user);
        }
        $user = Auth::user();
        $response = array(
            'token' => $user->createToken($this->appName)->accessToken
        );
        return $response;
    }

    /**
     * @throws ServiceException
     */
    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['first_name'],
            'email' => $data['email'],
            'password' => Hash::make("PaK8*I0A-0QSA"),
        ]);
        $response = array(
            'token' => $user->createToken($this->appName)->accessToken
        );
        return $response;
    }
    /**
     * @throws ServiceException
     */
    private function validateGoogleAuth(string $id_token): string
    {
        // $client = new Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        try {
            $payload = json_decode(file_get_contents("https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token));
            if (!$payload) {
                throw new ServiceException("Google Auth Failed");
            }
            return $payload->email;
        } catch (\Exception $e) {
            Log::error('Error in validateGoogleAuth: ' . $e->getMessage());

            throw new ServiceException("Google Auth Failed");
        }
    }

    /**
     * @throws ServiceException
     */
    private function validateAppleAuth(mixed $apple_token, mixed $email)
    {
        $applePublicKey = $this->getApplePublicKey();
        $appleUser = null;
        for ($i = 0; $i < count($applePublicKey); $i++) {
            try {
                $appleUser = JWT::decode($apple_token, JWK::parseKey($applePublicKey[$i]));
                if ($appleUser != null)
                    break;
            } catch (\Exception) {
                // ignore
            }
        }
        if ($appleUser == null) {
            throw new ServiceException("Login Failed");
        }
        if ($appleUser->email != $email && $email != null) {
            throw new ServiceException("Invalid Email Address");
        }
        if (!$appleUser) {
            throw new ServiceException("Apple Auth Failed");
        }
        return $appleUser->email;
    }

    /**
     * @throws ServiceException
     */
    private function validateSSO(array $data)
    {
        if ($data['sso'] == 'apple') {
            Log::info("Request received with payload", $data);
            return $this->validateAppleAuth($data['token'], $data['email']);
        } else if ($data['sso'] == 'google') {
            return $this->validateGoogleAuth($data['token']);
        } else if ($data['sso'] == 'self') {
            return "self";
        }
        throw new ServiceException("Invalid SSO Type");
    }
    /**
     * @return string[]
     */
    public function getApplePublicKey(): array
    {
        return json_decode(file_get_contents("https://appleid.apple.com/auth/keys"), true)['keys'];
    }
}
