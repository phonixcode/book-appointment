<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginSubmit(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        return Auth::guard('web')->attempt($credentials)
            ? redirect()->route('user.home')
            : redirect()->route('user.login')->with('error', 'Incorrect credentials');
    }

    public function registerSubmit(RegisterRequest $request)
    {
        $data = $request->all();
        $check = $this->create($data);

        Auth::login($check);

        return $check
            ? redirect()->route('user.login')
            : redirect()->back()->with('error', 'Something went wrong, failed to register');
    }

    private function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
