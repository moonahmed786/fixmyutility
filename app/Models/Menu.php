<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'location'];

    public function items()
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('order')->with('children');
    }

    public static function location(string $location): ?self
    {
        return static::where('location', $location)->first();
    }
}
