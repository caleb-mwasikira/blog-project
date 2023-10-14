<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostEditor extends PostController
{
    /**
     * Display a form for creating new posts
     */
    public function view_create_post_form()
    {
        if (!Gate::check("create", Post::class)) {
            return redirect()
                ->route("view_all_posts")
                ->with("fail", "Cannot create a post as you are not signed in as an author");
        }

        return view("posts.editor");
    }

    /**
     * Display a form for updating an existing post
     */
    public function view_edit_post_form(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $response = Gate::inspect("update", $post);

        if (!$response->allowed()) {
            return redirect()
                ->route("view_all_posts")
                ->with("fail", $response->message());
        }

        return view("posts.editor", [
            "post" => $post,
        ]);
    }


    /**
     * Handle post-editor form submission
     */
    public function handle_submit(Request $request)
    {
        switch ($request->input("submit_btn")) {
            case "new_post":
                return $this->create_post($request);
                break;

            case "edit_post":
                return $this->edit_post($request, null);
                break;

            case "publish_post":
                return $this->publish_post($request, null);
                break;

            case "delete_post":
                return $this->delete_post($request, null);
                break;

            default:
                return back()
                    ->with("fail", "Undefined user action");
                break;
        }
    }
}
