<?php

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
    return view('welcome');
});

Route::get("/posts", function () {
    $posts = Post::where("is_published", true)->get();

    return view("posts", [
        "posts" => $posts,
    ]);
});

Route::get("/posts/{post:id}", function (Post $post) {
    $post = Post::findOrFail($post->id);

    return view("post", [
        "post" => $post
    ]);
});
