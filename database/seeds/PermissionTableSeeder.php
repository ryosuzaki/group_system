<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name'=>'SuperAdmin']);
        
        //
        Permission::create(['name'=>'group.*']);
        foreach(config('kaigohack.role.group') as $action){
            Permission::create(['name'=>'group.'.$action]);
        }
        //
        Permission::create(['name'=>'group_info_bases.*']);
        foreach(config('kaigohack.role.group_info_bases') as $action){
            Permission::create(['name'=>'group_info_bases.'.$action]);
        }
        //
        Permission::create(['name'=>'group_info.*']);
        for($i=0;$i<config("group_system.role.max_num_of_info_bases");$i++){
            Permission::create(['name'=>'group_info.'.$i.'.*']);
            foreach(config('kaigohack.role.group_info') as $action){
                Permission::create(['name'=>'group_info.'.$i.'.'.$action]);
            }
        }
        //
        Permission::create(['name'=>'group_roles.*']);
        foreach(config('kaigohack.role.group_roles') as $action){
            Permission::create(['name'=>'group_roles.'.$action]);
        }
        //
        Permission::create(['name'=>'group_users.*']);
        for($i=0;$i<config("group_system.role.max_num_of_roles");$i++){
            Permission::create(['name'=>'group_users.'.$i.'.*']);
            foreach(config('kaigohack.role.group_users') as $action){
                Permission::create(['name'=>'group_users.'.$i.'.'.$action]);
            }
        }
    }
}
