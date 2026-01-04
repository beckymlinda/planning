<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    public function isCEO()
    {
        return $this->role === 'ceo';
    }

    public function isDirector()
    {
        return $this->role === 'director';
    }

    public function isAccounts()
    {
        return $this->role === 'accounts';
    }

    public function isDepartment()
    {
        return $this->role === 'department';
    }
}

