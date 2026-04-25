<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillAnalysis extends Model
{
    protected $fillable = [
        'bill_id', 'errors', 'overcharge_amount', 'currency',
        'dispute_letter', 'ai_response', 'report_pdf_path', 'status',
    ];

    protected $casts = [
        'errors' => 'array',
        'ai_response' => 'array',
        'overcharge_amount' => 'decimal:2',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
