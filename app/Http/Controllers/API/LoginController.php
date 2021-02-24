<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        } else {
            return response()->json([
                'error' => ['Пользователь с таким логином или паролем не найден.']
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
