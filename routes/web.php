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

Route::get("/posts", [PostController::class, 'view_all_posts']);
Route::get("/posts/{post:id}", [PostController::class, 'view_post']);

Route::get("/register", [AuthController::class, "view_register_page"])
    ->name("view_register_page")
    ->middleware("guest");
Route::post("/register", [AuthController::class, "register"]);

Route::get("/login", [AuthController::class, "view_login_page"])
    ->name("view_login_page")
    ->middleware("guest");
Route::post("/login", [AuthController::class, "login"]);

Route::post("/logout", [AuthController::class, "logout"]);

// TODO: Implement the forgot-password feature
