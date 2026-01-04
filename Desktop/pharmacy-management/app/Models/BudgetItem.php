<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'name',
        'unit_of_measure',
        'quantity',
        'frequency',
        'unit_cost',
        'total',
        'description',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'frequency' => 'integer',
        'unit_cost' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

