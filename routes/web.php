<?php

use App\Http\Controllers\Site\v1\AuthController;
use App\Http\Controllers\Site\v1\SiteController;
use Illuminate\Support\Facades\Route;

// middleware
use App\Http\Middleware\redirectIfUserLoggedIn;
use App\Http\Middleware\isUserLoggedIn;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::name("site.")->group(function () {

    Route::prefix("auth")->name("auth.")->controller(AuthController::class)->group(function () {
        Route::post("login", "login")->name("login");
        Route::post("register", "register")->name("register");
        Route::post("logout", "logout")->name("logout");
    });

    Route::middleware([redirectIfUserLoggedIn::class])->controller(SiteController::class)->group(function () {
        Route::get("register", "register")->name("register");
        Route::get("login", "login")->name("login");
    });

    Route::middleware([isUserLoggedIn::class])->controller(SiteController::class)->group(function () {
        Route::get("/", "index")->name("index");
    });
});

