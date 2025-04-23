<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private $appName = 'Quran City';

    public function auth(array $data)
    {
//        dd(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]));
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                Auth::login($user);
            } else {
                throw new ServiceException("Username and password not correct");
            }
        } else {
            return $this->register($data);
        }
        $user = Auth::user();
        $response = array(
            'token' => $user->createToken($this->appName)->accessToken
        );
        return $response;
    }

    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $response = array(
            'token' => $user->createToken($this->appName)->accessToken
        );
        return $response;
    }

    public function registerV2(array $data): array
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make("PaK8*I0A-0QSA"),
        ]);
        $response = array(
            'token' => $user->createToken($this->appName)->accessToken
        );
        return $response;
    }
}
