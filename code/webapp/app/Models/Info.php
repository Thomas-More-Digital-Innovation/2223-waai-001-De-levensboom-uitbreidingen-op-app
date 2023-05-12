<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ["section_id", "title", "orderNumber"];

    public function sections()
    {
        return $this->belongsTo(Section::class)->withDefault();
    }

    public function infoContents()
    {
        return $this->hasMany(InfoContent::class);
    }
}
