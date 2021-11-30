<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;

use Illuminate\Support\Facades\Gate;

use Validator;

class GroupRoleController extends Controller
{
    //
    public function index(Group $group)
    {
        Gate::authorize('viewAny-group-roles',$group);
        return view('group.role.index')->with([
            'group'=>$group,
            'roles'=>$group->roles()->get(),
        ]);
    }

    /**
     * 
     */
    public function create(Group $group)
    {
        Gate::authorize('create-group-roles',$group);
        return view('group.role.create')->with([
            'group'=>$group,
            'roles'=>$group->roles()->get(),
            ]);
    }

    /**
     * 
     */
    public function store(Request $request,Group $group)
    {
        Gate::authorize('create-group-roles',$group);
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'password'=>'required|alpha_num|min:4|max:255|confirmed',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $role=$group->createRole($request->name,$request->password);
        return redirect()->route('group.role.index',$group->id);
    }

    //
    public function edit(Group $group,int $index)
    {
        Gate::authorize('update-group-roles',[$group,$index]);
        return view('group.role.edit')->with([
            'group'=>$group,
            'role'=>$group->getRoleByIndex($index),
            ]);
    }

    /**
     * 
     */
    public function update(Request $request,Group $group,int $index)
    {
        Gate::authorize('update-group-roles',[$group,$index]);
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'now_password'=>'nullable|alpha_num|min:4|max:255',
            'password'=>'nullable|alpha_num|min:4|max:255|confirmed',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $role=$group->getRoleByIndex($index);
        //
        if($role->role_name!=$request->name){
            $role->changeName($request->name);
        }
        //
        if($request->password&&$role->checkPassword($request->now_password)){
            $role->changePassword($request->password);
        }
        return redirect()->route('group.role.index',$group->id);
    }

    /**
     * 
     */
    public function destroy(Group $group,int $index)
    {
        Gate::authorize('delete-group-roles',$group);
        $group->deleteRoleByIndex($index);
        return redirect()->back();
    }

    //
    public function editPermissions(Group $group,int $index)
    {
        Gate::authorize('permission-group-users',[$group,$index]);
        $role=$group->getRoleByIndex($index);
        return view('group.role.edit_permissions')->with([
            'group'=>$group,
            'type'=>$group->getType(),
            'role'=>$role,
            'permission_names'=>$role->permissions()->pluck('name'),
            ]);
    }

    //
    public function updatePermissions(Request $request,Group $group,int $index)
    {
        Gate::authorize('permission-group-users',[$group,$index]);
        $validator = Validator::make($request->all(),[
            'permissions.*'=>'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $role=$group->getRoleByIndex($index);
        //
        $role->syncPermissions((array)$request->permissions);
        return redirect()->route('group.role.index',$group->id);
    }
}
