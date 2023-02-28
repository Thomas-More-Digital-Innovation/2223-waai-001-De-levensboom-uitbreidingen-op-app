<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoContent extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ['info_id', 'title', 'titleImage', 'url', 'shortContent',  'content', 'orderNumber'];

    public function info()
    {
        return $this->belongsTo(Info::class);
    }
}
