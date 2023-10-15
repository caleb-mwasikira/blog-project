<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostEditor;
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
})->name("home");

/**
 * Post routes
 */

// TODO: Add middleware that prevents users from reaching
// certain endpoints if they are not of a specific role

Route::middleware(["auth"])->group(function () {
    Route::get("/posts/add", [PostEditor::class, "view_create_post_form"])
        ->name("view-create-post");
    Route::post("/posts", [PostController::class, "create_post"])
        ->name("create-post");

    Route::get("/my-posts", [PostController::class, "my_posts"])
        ->name("view-my-posts");
    Route::get("/my-posts/{post:id}", [PostController::class, "view_post"])
        ->name("view-my-post");

    Route::get("/posts/edit/{post:id}", [PostEditor::class, "view_edit_post_form"])
        ->name("view-edit-post");
    Route::post("/posts/editor", [PostEditor::class, "handle_submit"])
        ->name("post-editor");
    Route::post("/posts/{post:id}", [PostController::class, "edit_post"])
        ->name("edit-post");

    Route::delete("/posts/{post:id}", [PostController::class, "delete_post"])
        ->name("delete-post");
});

Route::get("/posts", [PostController::class, 'view_all_posts'])
    ->name("view-all-posts");
Route::get("/posts/{post:id}", [PostController::class, 'view_post'])
    ->name("view-post");

/**
 * Comments routes
 */
Route::get("/posts/{post:id}/comments", function (Post $post) {
    return redirect()
        ->to(route("view-post", ["post" => $post->id]) . "#comments");
});
Route::post("/posts/{post:id}/comments", [CommentController::class, "create_comment"])
    ->name("create-comment")
    ->middleware("auth");

/**
 * Authentication routes
 */

Route::get("/register", function () {
    return view("auth.register");
})
    ->name("register")
    ->middleware("guest");
Route::post("/register", [AuthController::class, "register"]);

Route::get("/login", function () {
    return view("auth.login");
})
    ->name("login")
    ->middleware("guest");
Route::post("/login", [AuthController::class, "login"]);

Route::post("/logout", [AuthController::class, "logout"])
    ->name("logout");

// TODO: Implement the forgot-password feature
