<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

use Validator;

class GroupUserController extends Controller
{
    //
    public function index(Group $group,int $index=0)
    {
        Gate::authorize('view-group-users',[$group,$index]);
        return view('group.user.index')->with([
            'group'=>$group,
            'role'=>$group->getRoleByIndex($index),
        ]);
    }
    //
    public function create(Group $group,int $index)
    {
        Gate::authorize('invite-group-users',[$group,$index]);
        return view('group.user.create')->with([
            'group'=>$group,
            'role'=>$group->getRoleByIndex($index),
            ]);
    }
    
    //
    public function store(Request $request,Group $group,int $index)
    {
        Gate::authorize('invite-group-users',[$group,$index]);
        $validator = Validator::make($request->all(),[
            'email'=>'required|string|email|max:255|exists:users,email',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $role=$group->getRoleByIndex($index);
        $user=User::findByEmail($request->email);
        $group->requestJoin($user->id,$role->id);
        return redirect()->back();
    }

    //
    public function storeByCsv(Request $request,Group $group,int $index){
        Gate::authorize('invite-group-users',[$group,$index]);
        $validator = Validator::make($request->all(),[
            'csv_file'=>'required|file|max:128|mimes:csv,txt|mimetypes:text/plain',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $role=$group->getRoleByIndex($index);
        $path=$request->file('csv_file')->getPathname();
        $records=Reader::createFromPath($path, 'r')->getRecords();
        foreach($records as $record){
            $user=User::findByEmail($record[0]);
            if($user){
                $group->requestJoin($user->id,$role->id);
            }else{
                return back()->withErrors(['store_by_csv_error'=>$record[0].'は不正なメールアドレスです。'])->withInput();
            }
        }
        return redirect()->back();
    }

    //
    public function show(Group $group,int $user_id,int $index)
    {
        Gate::authorize('view-group-users',[$group,$index]);
        return view('group.user.show')->with([
            'group'=>$group,
            'index'=>$index,
            'user'=>$group->getUser($user_id),
            'bases'=>$group->getUserInfoBases($user_id),
            ]);
    }

    //
    public function destroy(Group $group,int $user_id,int $index)
    {
        Gate::authorize('remove-group-users',[$group,$index]);
        $group->removeUser($user_id);
        return redirect()->route('group.user.index',[$group->id,$index]);
    }

    //
    public function quitRequestJoin(Group $group,int $user_id,int $index){
        Gate::authorize('invite-group-users',[$group,$index]);
        $group->quitRequestJoin($user_id);
        return redirect()->route('group.user.index',[$group->id,$index]);
    }
}
