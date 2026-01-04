<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'pillar_id',
        'name',
        'description',
    ];

    public function pillar()
    {
        return $this->belongsTo(Pillar::class);
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class);
    }
}

