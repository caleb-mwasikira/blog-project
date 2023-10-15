<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Validate post data
     *
     * @return array validated post attributes
     */
    protected function validate_post_data(Request $request, string $mode = "create"): array
    {
        $categories = Category::all();
        $categoryNames = $categories->map(fn($item, $key) => $item["name"]);
        $attributes = $request->validate([
            "title" => [
                "required",
                $mode == "create" ? "unique:posts" : "",
                "min:10", "max:255",
            ],
            "body" => "required|min:50",
            "category" => ["required", Rule::in($categoryNames)],
        ]);

        // Add the category_id column to the Post model
        $category_id = $categories->firstWhere("name", $attributes["category"])["id"];
        $attributes["category_id"] = $category_id;

        // Remove category data from model attributes, so we can save
        // without getting an SQL error caused by `category` being an
        // unknown column on the posts table
        unset($attributes["category"]);

        // Add the user_id column to the Post model
        $attributes["user_id"] = Auth::user()->id;
        return $attributes;
    }

    public function create_post(Request $request)
    {
        if (!Gate::check("create-post", Post::class)) {
            return to_route("view-all-posts")
                ->with("fail", "Cannot create a post as you are not signed in as an author");
        }

        $attributes = $this->validate_post_data($request);
        $post = new Post($attributes);
        $post->save();

        return to_route("edit-post", [
            "post" => $post->id,
        ])->with("success", "Post created");
    }

    public function view_all_posts()
    {
        $posts = Post::published()
            ->filter([
                "search" => request("search"),
                "category" => request("category"),
                "author" => request("author"),
            ])->get();

        return view("posts.all", [
            "posts" => $posts,
        ]);
    }

    public function view_post(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $response = Gate::inspect("view", $post);

        if (!$response->allowed()) {
            return to_route("view-all-posts")
                ->with("fail", $response->message());
        }

        return view("posts.show", [
            "post" => $post,
            // "is_author" => true
        ]);
    }

    /**
     * View all posts created by the currently logged in user
     */
    public function my_posts(Request $request)
    {
        if (!Gate::check("create-post", Post::class)) {
            return to_route("view_all_posts")
                ->with("fail", "You do not have any created posts as you are not signed in as an author");
        }

        $posts = Post::filter([
            "author" => $request->user()->username,
        ])->get();

        return view("posts.all", [
            "posts" => $posts,
        ]);
    }

    public function edit_post(Request $request, ?Post $post)
    {
        $post_id = $post?->id ?? $request->input("post_id");
        $post = Post::findOrFail($post_id);

        $response = Gate::inspect("update", $post);

        if (!$response->allowed()) {
            return to_route("edit-post", [
                "post" => $post,
            ])->with("fail", $response->message());
        }

        $attributes = $this->validate_post_data($request, $mode = "update");

        $post->fill($attributes);
        $post->push();

        return to_route("view-edit-post", ["post" => $post->id])
            ->with("success", "Saving post changes");
    }

    public function publish_post(Request $request, ?Post $post)
    {
        $post_id = $post?->id ?? $request->input("post_id");
        $post = Post::findOrFail($post_id);

        $response = Gate::inspect("update", $post, $responseMsg = "Cannot publish post that you do not own");

        if (!$response->allowed()) {
            return to_route("view-edit-post", [
                "post" => $post,
            ])->with("fail", $response->message());
        }

        if ($post->is_published) {
            return to_route("view-edit-post", [
                "post" => $post,
            ])->with("fail", "Cannot publish post that has already been published");
        }

        // Set post to published and save model to the db
        $post->is_published = true;
        $post->published_at = now();
        $post->save();

        return to_route("view-edit-post", ["post" => $post->id])
            ->with("success", "Post has been published successfully");
    }

    public function delete_post(Request $request, ?Post $post)
    {
        $post_id = $post?->id ?? $request->input("post_id");
        $post = Post::findOrFail($post_id);

        $response = Gate::inspect("delete", $post);

        if (!$response->allowed()) {
            return to_route("view-edit-post", [
                "post" => $post,
            ])->with("fail", $response->message());
        }

        $post->delete();
        return to_route("view-all-posts", ["post" => $post->id])
            ->with("success", "Post deleted successfully");
    }
}
