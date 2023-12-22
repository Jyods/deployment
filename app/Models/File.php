<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    use HasFactory;
    //This belongs to member and entry
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
    public function fileLaw()
    {
        return $this->hasMany(FileLaw::class);
    }
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }
}
