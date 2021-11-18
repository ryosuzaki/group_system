<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Info\Info;
use App\Models\Info\InfoBase;

use Illuminate\Support\Facades\Gate;

use App\Models\Group\Group;

class GroupInfoController extends Controller
{
    //
    public function edit(Group $group,int $index)
    {
        Gate::authorize('update-group-info',[$group,$index]);
        $base=$group->getInfoBaseByIndex($index);
        return view('group.info.edit')->with([
            'group'=>$group,
            'base'=>$base,
            'info'=>$base->info(),
            'index'=>$index,
            ]);
    }

    //
    public function update(Request $request,Group $group,int $index)
    {
        Gate::authorize('update-group-info',[$group,$index]);
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group->getInfoBaseByIndex($index)->updateInfo($request->toArray()['info']);
        return redirect()->route('group.show',[$group->id,$index]);
    }
}
