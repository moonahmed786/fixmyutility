<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'icon', 'order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
