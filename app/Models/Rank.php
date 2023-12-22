<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function file()
    {
        return $this->hasMany(File::class);
    }
    public function securityLevel()
    {
        return $this->belongsTo(SecurityLevel::class);
    }
}
