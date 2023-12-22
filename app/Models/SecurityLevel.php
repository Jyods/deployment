<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityLevel extends Model
{
    use HasFactory;

    public function rank()
    {
        return $this->hasMany(Rank::class);
    }
}
