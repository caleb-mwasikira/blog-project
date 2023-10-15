<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function create_comment(Request $request, Post $post)
    {
        if(!Gate::allows("create-comment", [$post])) {
            return to_route("view-post", ["post" => $post])
                ->with("fail", "Cannot create comment on unpublished post");
        }

        $attributes = $request->validate([
            "body" => "min:1|max:255",
        ]);
        $attributes["user_id"] = $request->user()->id;
        $attributes["post_id"] = $post->id;

        $comment = new Comment($attributes);
        $comment->push();

        return to_route("view-post", ["post" => $post->id])
            ->with("success", "You have commented on this post");
    }
}
