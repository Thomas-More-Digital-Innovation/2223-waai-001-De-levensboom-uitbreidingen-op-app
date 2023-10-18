<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionUserList extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ["question_list_id", "user_id", "active"];

    public function questionLists()
    {
        return $this->belongsTo(QuestionList::class)->withDefault();
    }

    public function users()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
