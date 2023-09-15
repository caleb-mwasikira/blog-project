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

    public function render()
    {
        //
    }
}
