<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ["tree_part"];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
