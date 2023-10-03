<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view("index");
});

Route::get("/posts", [PostController::class, 'index']);
Route::get("/posts/{post:id}", [PostController::class, 'show']);

Route::get("/register", [AuthController::class, "get_register_view"])
    ->name("register")
    ->middleware("guest");
Route::post("/register", [AuthController::class, "register"]);

Route::get("/login", [AuthController::class, "get_login_view"])
    ->name("login")
    ->middleware("guest");
Route::post("/login", [AuthController::class, "login"]);

Route::post("/logout", [AuthController::class, "logout"]);

// TODO: Implement the forgot-password feature