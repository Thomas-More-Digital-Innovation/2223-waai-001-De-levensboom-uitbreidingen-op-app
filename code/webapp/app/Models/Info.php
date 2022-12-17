<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    public function sections()
    {
        return $this->belongsTo(Section::class);
    }

    public function infoContents()
    {
        return $this->hasMany(InfoContent::class);
    }
}
