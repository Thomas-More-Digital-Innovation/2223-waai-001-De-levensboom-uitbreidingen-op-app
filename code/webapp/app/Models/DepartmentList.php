<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentList extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(MyUser::class);
    }

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function departments()
    {
        return $this->belongsTo(Department::class);
    }
}
