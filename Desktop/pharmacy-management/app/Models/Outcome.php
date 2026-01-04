<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_id',
        'name',
        'description',
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}

