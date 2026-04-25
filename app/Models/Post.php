<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = ['post_category_id', 'title', 'slug', 'excerpt', 'content', 'featured_image', 'is_active', 'published_at'];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_active', true)->whereNotNull('published_at')->where('published_at', '<=', now());
    }
}
