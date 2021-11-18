<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

use App\Models\Group\Group;
use App\Policies\GroupPolicy;

use App\Policies\GroupInfoBasesPolicy;
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
        foreach (config('kaigohack.role.group_info_bases') as $action){
            Gate::define($action.'-group-info-bases','App\Policies\GroupInfoBasesPolicy@'.$action);    
        }
        //
        foreach (config('kaigohack.role.group_info') as $action){
            Gate::define($action.'-group-info','App\Policies\GroupInfoPolicy@'.$action);    
        }
        //
        foreach (config('kaigohack.role.group_roles') as $action){
            Gate::define($action.'-group-roles','App\Policies\GroupRolesPolicy@'.$action);
        }
        //
        foreach (config('kaigohack.role.group_users') as $action){
            Gate::define($action.'-group-users','App\Policies\GroupUsersPolicy@'.$action);
        }
    }
}
