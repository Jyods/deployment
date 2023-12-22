<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Law extends Model
{
    use HasFactory;

    public function fileLaw()
    {
        return $this->hasMany(FileLaw::class);
    }
}
