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
    return view('index');
});

Route::get("/posts", function () {
    $posts = Post::with(["user", "category"])->where("is_published", true)->get();
    
    return view("posts-view", [
        "posts" => $posts,
    ]);
});

Route::get("/posts/{post:id}", function (Post $post) {
    $post = Post::with(["user", "category"])->findOrFail($post->id);
    
    return view("post-view", [
        "post" => $post
    ]);
});
