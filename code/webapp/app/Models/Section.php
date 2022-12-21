<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ['name',];

    public function infos()
    {
        return $this->hasMany(Info::class);
    }
}
