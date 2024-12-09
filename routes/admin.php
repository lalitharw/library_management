<?php

// controller
use App\Http\Controllers\Admin\v1\AuthController;
use App\Http\Controllers\Admin\v1\CategoryController;
use App\Http\Controllers\Admin\v1\DashboardController;

// middleware
use App\Http\Middleware\isAdminLoggedIn;
use Illuminate\Support\Facades\Route;


Route::middleware([isAdminLoggedIn::class])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get("/", "index")->name("index");
    });

    Route::prefix("category")->name("category.")->controller(CategoryController::class)->group(function () {
        Route::post("store", "store")->name("store");
        Route::post("/", "index")->name("index");
    });
});

Route::prefix("auth")->name("auth.")->controller(AuthController::class)->group(function () {
    Route::post("login", "login")->name("login");
    Route::get("logout", "logout")->name("logout");
});

Route::controller(AuthController::class)->group(function () {
    Route::get("login", "loginPage")->name("loginPage");
});
