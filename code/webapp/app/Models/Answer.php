<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ['my_user_id', 'question_id', 'answer'];

    public function users()
    {
        return $this->belongsTo(MyUser::class);
    }

    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
}
