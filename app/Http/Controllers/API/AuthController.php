<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function auth(AuthRequest $request): JsonResponse
    {
        return $this->sendResponse($this->authService->auth($request->validated()));
    }
}
