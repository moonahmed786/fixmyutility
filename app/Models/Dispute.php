<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    protected $fillable = [
        'bill_id', 'user_id', 'bill_analysis_id',
        'status', 'letter_pdf_path', 'notes', 'sent_at', 'resolved_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function analysis()
    {
        return $this->belongsTo(BillAnalysis::class, 'bill_analysis_id');
    }
}
