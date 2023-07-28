<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayType extends Model
{
    use HasFactory;

    public function invoice()
    {
        $this->hasMany(Invoice::class);
    }
}
