<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoContent extends Model
{
    use HasFactory;

    public function info()
    {
        return $this->belongsTo(Info::class);
    }
}
