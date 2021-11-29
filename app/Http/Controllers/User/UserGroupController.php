<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Group\Group;

use Illuminate\Support\Facades\Auth;

use Validator;

class UserGroupController extends Controller
{
    //
    public function index()
    {
        $user=Auth::user();
        return view('user.group.index')->with([
            'user'=>$user,
            'groups'=>$user->groups()->get(),
            'requests'=>$user->groupsRequestJoin()->get(),
            ]);
    }

    /*
    public function edit(Group $group)
    {
        return view('user.group.edit')->with([
                'group'=>$group,
                'user'=>Auth::user(),
            ]);
    }

    //
    public function update(Request $request,Group $group)
    {
        $validator = Validator::make($request->all(),[
            'role_id'=>'required|integer|min:1|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        if(!$group->checkRolePassword((int)$request->role_id,$request->password)){
            return back()->withInput();
        }
        $group->inviteUser(Auth::user(),(int)$request->role_id);
        return redirect()->route('user.group.index');
    }
    */

    //
    public function destroy(Group $group)
    {
        Auth::user()->leaveGroup($group->id);
        return redirect()->route('user.group.index');
    }

    //
    public function acceptJoinRequest(Group $group){
        Auth::user()->acceptGroupJoinRequest($group->id);
        return redirect()->back();
    }
    //
    public function deniedJoinRequest(Group $group){
        Auth::user()->deniedGroupJoinRequest($group->id);
        return redirect()->back();
    }
}
