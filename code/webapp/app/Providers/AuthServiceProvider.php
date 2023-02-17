<?php

namespace App\Providers;
use App\Models\Department;
use App\Models\Question;
use App\Policies\QuestionPolicy;
use App\Models\User;
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
            return $user->user_type_id === 1;
        });
    }
}
