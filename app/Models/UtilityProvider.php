<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilityProvider extends Model
{
    protected $fillable = ['name', 'country', 'utility_type', 'logo', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('name');
    }
}
