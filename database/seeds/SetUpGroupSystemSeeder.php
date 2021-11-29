<?php

use Illuminate\Database\Seeder;

use App\Models\Group\GroupType;

use App\Models\Info\InfoTemplate;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SetUpGroupSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * 
         */
        GroupType::setUp();

        /**
         * 
         */
        InfoTemplate::setUp();
        
        /**
         * 
         */
        Role::create(['name'=>'SuperAdmin']);
        //
        Permission::create(['name'=>'group.*']);
        foreach(config('group_system.role.group') as $action){
            Permission::create(['name'=>'group.'.$action]);
        }
        //
        Permission::create(['name'=>'group_infos.*']);
        foreach(config('group_system.role.group_infos') as $action){
            Permission::create(['name'=>'group_infos.'.$action]);
        }
        //
        Permission::create(['name'=>'group_info.*']);
        for($i=0;$i<config("group_system.role.max_num_of_infos");$i++){
            Permission::create(['name'=>'group_info.'.$i.'.*']);
            foreach(config('group_system.role.group_info') as $action){
                Permission::create(['name'=>'group_info.'.$i.'.'.$action]);
            }
        }
        //
        Permission::create(['name'=>'group_roles.*']);
        foreach(config('group_system.role.group_roles') as $action){
            Permission::create(['name'=>'group_roles.'.$action]);
        }
        //
        Permission::create(['name'=>'group_users.*']);
        for($i=0;$i<config("group_system.role.max_num_of_roles");$i++){
            Permission::create(['name'=>'group_users.'.$i.'.*']);
            foreach(config('group_system.role.group_users') as $action){
                Permission::create(['name'=>'group_users.'.$i.'.'.$action]);
            }
        }
    }
}
