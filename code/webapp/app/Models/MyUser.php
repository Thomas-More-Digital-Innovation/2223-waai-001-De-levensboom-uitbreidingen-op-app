<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ['user_type_id', 'firstname', 'surname', 'birthdate', 'email', 'password', 'phoneNumber', 'gender',
                             'street', 'houseNumber', 'city', 'zipCode',];

    public function user_types()
    {
        return $this->belongsTo(UserType::class);
    }

    public function department_lists()
    {
        return $this->hasMany(DepartmentList::class);
    }

    public function mentors() {
        return $this->belongsToMany(MyUser::class, 'UserList', 'client_id', 'mentor_id');
    }

    public function clients() {
        return $this->belongsToMany(MyUser::class, 'UserList', 'mentor_id', 'client_id');
    }

    public function answers()
    {
        return $this->hasmany(Answer::class);
    }
}
