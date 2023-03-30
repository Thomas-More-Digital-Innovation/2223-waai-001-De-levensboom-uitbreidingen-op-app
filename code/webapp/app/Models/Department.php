<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = [
        "name",
        "street",
        "houseNumber",
        "city",
        "zipcode",
        "email",
        "phoneNumber",
    ];

    public function department_lists()
    {
        return $this->hasMany(DepartmentList::class);
    }
}
