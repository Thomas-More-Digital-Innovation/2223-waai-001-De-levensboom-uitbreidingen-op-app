<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentList extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ["user_id", "role_id", "department_id"];

    public function users()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function roles()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }

    public function departments()
    {
        return $this->belongsTo(Department::class)->withDefault();
    }
}
