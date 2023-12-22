<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileLaw extends Model
{
    use HasFactory;

    public function file()
    {
        return $this->belongsTo(File::class);
    }
    public function law()
    {
        return $this->belongsTo(Law::class);
    }
}
