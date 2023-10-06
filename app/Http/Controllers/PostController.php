<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    /**
     * Display all posts to the user
     * 
     */
    public function view_all_posts()
    {
        $posts = Post::published()
            ->filter([
                "search" => request("search"),
                "category" => request("category"),
                "author" => request("author"),
            ])->get();

        return view("posts.view-all-posts", [
            "posts" => $posts,
        ]);
    }

    /**
     * Display a single post based on its id
     * 
     */
    public function view_post(Post $post)
    {
        $post = Post::published()->findOrFail($post->id);

        return view("posts.view-post", [
            "post" => $post,
        ]);
    }
}
