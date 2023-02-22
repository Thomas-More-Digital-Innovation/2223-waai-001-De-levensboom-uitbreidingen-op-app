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

        // This Gate is to check if a user is an Admin.
        Gate::define('allowAdmin', function (User $user){
            // Get the userTypeID of the user
            $userTypeId = $user->user_type_id;
            // Check the usertype of the user
            $userType = UserType::find($userTypeId)->id;

            return $userType === 1; // Admin
        });

        // This Gate is to check if a user is allowed to edit a user.
        Gate::define('editUser', function (User $user, int $userId){
            // Get the userTypeId of the user
            $userTypeId = $user->user_type_id;
            // Check the usertype of the user
            $userType = UserType::find($userTypeId)->id;

            return $userType === 1 || $user->id === $userId; // Admin, user themselfs
        });

	    // This Gate is to check if a user is allowed to edit departments.
        Gate::define('editDepartment', function (User $user, int $departmentId) {
            // Get the userTypeId of the user
            $userTypeId = $user->user_type_id;
            // Check the usertype of the user
            $userType = UserType::find($userTypeId)->id;

            // check if there is a departmentList
            if(DepartmentList::where('department_id', $departmentId)
                ->where('user_id', $user->id)->exists()){
                    // Find correct departmentList with departmentId and userId
                    $departmentList = DepartmentList::where('department_id', $departmentId)
                    ->where('user_id', $user->id)
                    ->first();
        
                    // Get the role of the user
                    $userRole = Role::find($departmentList->role_id)->id;
                } else {
                    $userRole = 0;
                }

            

            return ($userType === 3 // Mentor
                    && $userRole === 1) // Department Head
                    || $userType === 1; // Admin
        });

        // This Gate is to check if a user is allowed to assign another user to a department.
        Gate::define('createDepartmentList', function(User $user, int $departmentId) {
            // Get the userTypeId of the user
            $userTypeId = $user->user_type_id;
            // Check the usertype of the user
            $userType = UserType::find($userTypeId)->id;

            // Is the user a Department Head?
            if(DepartmentList::where('department_id', $departmentId)
                ->where('user_id', $user->id)->exists()) {
                    // Get the role of the user
                    $roleId = DepartmentList::where('department_id', $departmentId)
                    ->where('user_id', $user->id)->role_id;

                    $role = Role::find($roleId)->id;
                    return  $role === 1; // Department Head
                }
            else {
                return $userType === 1; // Admin
            }
        });
    }
}
