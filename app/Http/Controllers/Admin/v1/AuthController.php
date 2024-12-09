<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// models
use App\Models\Admin;

class AuthController extends Controller
{
    public function loginPage()
    {

        return view("admin.auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            "password" => "required",
            "email" => "required|email"
        ]);

        $admin = Admin::where("email", $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            Auth::guard('admin')->login($admin);

            return response([
                "message" => "Okay",
                "success" => true
            ], 200);

        } else {

            return response([
                "message" => "InValid Credentials",
                "success" => false
            ], 400);
        }



    }

    public function logout()
    {
        Auth::guard("admin")->logout();

        return redirect()->route("admin.loginPage");
    }


}
