<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAttempt(LoginRequest $request)
    {
        if ($this->authService->attemptLogin($request->only('email', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerAttempt(RegisterRequest $request)
    {
        $this->authService->createUser($request->only('name', 'email', 'password'));

        return redirect()->route('login')->with('success', 'Registration successful, please log in.');
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')->with('success', 'Logout successful');
    }
}
