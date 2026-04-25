<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'company', 'country', 'content', 'rating', 'avatar', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'rating' => 'integer'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->latest();
    }
}
