<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Plan extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'slug', 'description',
        'price_usd', 'price_gbp', 'price_cad',
        'stripe_price_id_usd', 'stripe_price_id_gbp', 'stripe_price_id_cad',
        'features', 'bill_limit', 'is_active', 'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'features' => 'array',
        'price_usd' => 'decimal:2',
        'price_gbp' => 'decimal:2',
        'price_cad' => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function priceFor(string $currency): float
    {
        return match (strtoupper($currency)) {
            'GBP' => (float) $this->price_gbp,
            'CAD' => (float) $this->price_cad,
            default => (float) $this->price_usd,
        };
    }

    public function stripePriceFor(string $currency): ?string
    {
        return match (strtoupper($currency)) {
            'GBP' => $this->stripe_price_id_gbp,
            'CAD' => $this->stripe_price_id_cad,
            default => $this->stripe_price_id_usd,
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
