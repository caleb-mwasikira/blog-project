<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public function __construct(
        public string $img_src,
        public string $category,
        public string $title,
        public string $slug,
        public string $body,
        public string $author,
        public string $published_date
    ) {

    }

    public static function all()
    {
        $files = File::files(resource_path("posts/"));

        // Loop through each file,
        // parse the file with yaml-front-matter,
        // return an array of Post objects,
        // and cache the result
        $cache_ttl = 4;
        $posts = cache()->remember("posts.all", $cache_ttl, function () use ($files) {
            return collect($files)->map(function ($file) {
                $document = YamlFrontMatter::parseFile($file);

                return new Post(
                    $img_src = $document->img_src,
                    $category = $document->category,
                    $title = $document->title,

                    // TODO: Create a function for generating slugs from post titles
                    $slug = $document->slug,
                    $body = $document->body(),
                    $author = $document->author,
                    $published_date = $document->published_date
                );
            });
        });

        return $posts;
    }

    private static function find(string $slug)
    {
        $posts = static::all();

        return $posts->firstWhere(function ($post, $key) use ($slug) {
            return $post->slug == $slug;
        });
    }

    public static function findOrFail(string $slug) {
        $post = static::find($slug);

        if(!$post) {
            abort(404);
        }

        return $post;
    }
}
