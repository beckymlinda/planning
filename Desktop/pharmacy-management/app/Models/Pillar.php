<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pillar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}

