<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\PasswordReset;
use App\Notifications\Survey;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_type_id",
        "firstname",
        "surname",
        "birthdate",
        "email",
        "password",
        "phoneNumber",
        "gender",
        "street",
        "houseNumber",
        "city",
        "zipcode",
        "survey",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function userTypes()
    {
        return $this->belongsTo(UserType::class)->withDefault();
    }

    public function department_lists()
    {
        return $this->hasMany(DepartmentList::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function user_list()
    {
        return $this->hasMany(UserList::class);
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
}
