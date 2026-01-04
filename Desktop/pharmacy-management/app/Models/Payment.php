<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'voucher_number',
        'payment_date',
        'amount',
        'payee',
        'description',
        'bank_slip_path',
        'receipt_path',
        'invoice_path',
        'status',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'approved_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

