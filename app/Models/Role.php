<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    // Relatioship with users
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}