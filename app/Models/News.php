<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image',
        'author',
        'author_user_id',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published'  => 'boolean',
        'published_at'  => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function authorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }

    public static function generateSlug(string $title): string
    {
        $slug = mb_strtolower(trim(preg_replace('/[^A-Za-z0-9\\s-]/', '', $title)));
        $slug = preg_replace('/\\s+/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $base = $slug;
        $count = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $count++;
        }
        return $slug;
    }
}
