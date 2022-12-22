<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ['name'];
    
    public function department_lists()
    {
        return $this->hasMany(DepartmentList::class);
    }
}
