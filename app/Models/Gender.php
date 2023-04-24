<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Gender extends Model
{
    use HasFactory;

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function client(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
