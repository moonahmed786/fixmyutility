<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Bill extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id', 'utility_provider_id', 'utility_type',
        'currency', 'amount', 'billing_period_start', 'billing_period_end',
        'file_path', 'extracted_text', 'status',
    ];

    protected $casts = [
        'billing_period_start' => 'date',
        'billing_period_end' => 'date',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(UtilityProvider::class, 'utility_provider_id');
    }

    public function analysis()
    {
        return $this->hasOne(BillAnalysis::class)->latest();
    }

    public function dispute()
    {
        return $this->hasOne(Dispute::class)->latest();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('bill')->singleFile();
    }
}
