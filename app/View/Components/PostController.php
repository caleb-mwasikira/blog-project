<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostController extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view("index");
    }

    public function viewPosts()
    {
        $posts = Post::published()
            ->filter([
                "search" => request("search"),
                "category" => request("category"),
                "author" => request("author"),
            ])->get();

        return view("view-posts", [
            "posts" => $posts,
        ]);
    }

    public function viewPost(Post $post)
    {
        $post = Post::published()->findOrFail($post->id);

        return view("view-post", [
            "post" => $post,
        ]);
    }

    public function render()
    {
        //
    }
}
