<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'code',
        'description',
        'budget_amount',
        'start_date',
        'end_date',
        'status',
        'budget_year',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget_amount' => 'decimal:2',
        'budget_year' => 'integer',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function budgetItems()
    {
        return $this->hasMany(BudgetItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalBudgetedAttribute()
    {
        return $this->budgetItems()->sum('amount');
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getRemainingBudgetAttribute()
    {
        return $this->budget_amount - $this->total_paid;
    }
}

