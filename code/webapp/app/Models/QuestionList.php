<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionList extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ["title"];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function questionUserList()
    {
        return $this->hasmany(QuestionUserList::class);
    }
}
