<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->filter([
                "search" => request("search"),
                "category" => request("category"),
                "author" => request("author"),
            ])->get();

        return view("posts.index", [
            "posts" => $posts,
        ]);
    }

    public function show(Post $post)
    {
        $post = Post::published()->findOrFail($post->id);

        return view("posts.show", [
            "post" => $post,
        ]);
    }
}
