<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

use App\Models\Group\Group;
use App\Policies\GroupPolicy;

use App\Policies\GroupInfosPolicy;
use App\Policies\GroupInfoPolicy;

use App\Policies\GroupRolePolicy;
use App\Policies\GroupRolesPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        Group::class=>GroupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        Gate::before(function ($user, $ability) {
            return $user->hasRole('SuperAdmin') ? true : null;
        });

        //
        foreach (config('group_system.role.group_infos') as $action){
            Gate::define($action.'-group-infos','App\Policies\GroupInfosPolicy@'.$action);    
        }
        //
        foreach (config('group_system.role.group_info') as $action){
            Gate::define($action.'-group-info','App\Policies\GroupInfoPolicy@'.$action);    
        }
        //
        foreach (config('group_system.role.group_roles') as $action){
            Gate::define($action.'-group-roles','App\Policies\GroupRolesPolicy@'.$action);
        }
        //
        foreach (config('group_system.role.group_users') as $action){
            Gate::define($action.'-group-users','App\Policies\GroupUsersPolicy@'.$action);
        }
    }
}
