<?php

namespace App\Http\Controllers\Site\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        return view("site.home");
    }

    public function register()
    {
        return view("site.auth.register");
    }

    public function login()
    {
        return view("site.auth.login");
    }
}
