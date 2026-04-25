<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'service_slug',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_slug', 'slug');
    }
}
