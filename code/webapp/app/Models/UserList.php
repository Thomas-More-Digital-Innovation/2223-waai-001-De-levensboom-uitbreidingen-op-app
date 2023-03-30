<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    use HasFactory;

    protected $fillable = ["client_id", "mentor_id"];

    public function client()
    {
        return $this->belongsTo(User::class, "client_id");
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, "mentor_id");
    }
}
