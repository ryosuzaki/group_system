<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

use App\Models\Components\Location;

use Illuminate\Support\Facades\Gate;

use Validator;

class LocationController extends Controller
{
    //
    public function index($type){
        $type=GroupType::findByIdOrName($type);
        $tmp_groups=$type->groups()->get();
        $groups=[];
        foreach($tmp_groups as $group){
            if($group->isLocationSet()){
                $groups[]=$group;
            }
        }
        return view('group.components.map.map')->with(["groups"=>$groups]);
    }


    //
    public function show(Group $group){
        $type=$group->getType();
        $tmp_groups=$type->groups()->get();
        $groups=[];
        foreach($tmp_groups as $tmp_group){
            if($tmp_group->isLocationSet()){
                $groups[]=$tmp_group;
            }
        }
        return view('group.components.map.map')->with(['initial_group'=>$group,'groups'=>$groups]);
    }

    //
    public function setHere(Request $request,Group $group){
        Gate::authorize('update', $group);
        $validator = Validator::make($request->all(),[
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group->setLocation((float)$request->latitude,(float)$request->longitude);
        return redirect()->back();
    }
}
