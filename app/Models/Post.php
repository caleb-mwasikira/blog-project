<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    /**
     * Declaring mass assignable fields
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "category_id",
        "title",
        "body",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array<string>
     */
    protected $with = [
        "user", "category",
    ];

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Category that belongs to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scope a query to only include published posts
     */
    public function scopePublished(Builder $query)
    {
        $query->where("is_published", true);
    }

    /**
     * Scope a query to search for posts based on user defined
     * filters; title, body, category and author
     *
     * @var Builder -> default parameter based to all scope methods
     * @var array filters to apply on our queries ->
     * Example:
     * [
     *      "search"    => "", // Searches a post's title and body
     *      "category"  => "Peeka Boo", // Search a post by category
     *      "author"    => "Perrish Willins" // Search a post by author
     * ]
     *
     */
    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters["search"] ?? false, function (Builder $query, string $search) {
            $query->where("title", "like", '%' . $search . '%')
                ->orWhere("body", "like", $search);
        });

        $query->when($filters["category"] ?? false, function (Builder $query, string $category) {
            $query->whereHas("category", fn(Builder $query) =>
                $query->where("name", $category)
            );
        });

        $query->when($filters["author"] ?? false, function (Builder $query, string $author) {
            $query->whereHas("user", fn(Builder $query) =>
                $query->where("username", $author)
            );
        });
    }
}
