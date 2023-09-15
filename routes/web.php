<?php

use App\Models\Post;
use App\View\Components\PostController;
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

Route::get('/', [PostController::class, 'index']);
Route::get("/posts", [PostController::class, 'viewPosts']);
Route::get("/posts/{post:id}", [PostController::class, 'viewPost']);
