<?php

namespace App\Providers;
use App\Models\Department;
use App\Models\DepartmentList;
use App\Models\Role;
use App\Models\Question;
use App\Models\User;
use App\Models\UserType;
use App\Policies\QuestionPolicy;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Question::class => QuestionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
        // Gate defines wether or not a user is allowed to do a specific action
	    // This Gate is to check if a user is a mentor.
        Gate::define('mentor', function (User $user) {
            // Get the usertype of the user
            $userTypeId = $user->user_type_id;
            $userType = UserType::find($userTypeId);
            // Get the role of the user
            $userRoleId = $user->role_id;
            $userRole = Role::find($userRoleId);


            return ($userType === 'Mentor' || $userType === 'Admin') 
                    && ($userRole === 'Mentor' || $userRole === 'Department Head');
        });
    }
}
