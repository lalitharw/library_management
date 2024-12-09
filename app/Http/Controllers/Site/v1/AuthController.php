<?php

namespace App\Http\Controllers\Site\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// models
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([

            "password" => "required|string",
            "email" => "required|email"
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return response([
                "message" => "Email not Registered",
                "success" => false
            ], 400);
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return response([
                "success" => true,
            ], 200);
        } else {
            return response([
                "success" => false,
                "message" => "Username or Password Incorrect"
            ], 400);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            "password" => "required|string",
            "email" => "required|email"
        ]);

        $user = new User();

        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        Auth::login($user);

        return redirect()->route("site.index");
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route("site.login");
    }
}
