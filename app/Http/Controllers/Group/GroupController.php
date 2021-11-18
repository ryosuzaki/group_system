<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;

use Validator;


class GroupController extends Controller
{   
    //
    public function index(GroupType $type)
    {
        Gate::authorize('viewAny', [Group::class,$type]);
    }

    //
    public function create(GroupType $type)
    {
        return view('group.create')->with(['type'=>$type]);
    }

    //
    public function store(Request $request,GroupType $type)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::setUp(Auth::id(),$request->name,$type);
        return redirect()->route('group.show',$group->id);
    }

    //
    public function storeWithLocation(Request $request,GroupType $type){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::setUp(Auth::id(),$request->name,$type);
        if($request->latitude&&$request->longitude){
            $group->setLocation((float)$request->latitude,(float)$request->longitude);
        }
        return redirect()->route('group.show',$group->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group,int $index=0)
    {
        if(Auth::user()->hasGroup($group->id)){
            $bases=$group->getViewableInfoBasesByRole(Auth::user()->getRoleByGroup($group->id)->id);
        }else{
            $bases=$group->getViewableInfoBases();
        }
        return view('group.show')->with([
            'group'=>$group,
            'type'=>$group->getType(),
            'bases'=>$bases,
            'index'=>$index,
            ]);
    }

    public function getInfo(Group $group,int $index=0)
    {
        Gate::authorize('view-group-info',[$group,$index]);
        $base=$group->getInfoBaseByIndex($index);
        return response()->view('group.info.show.'.$base->info_template_id, ['base'=>$base,'info'=>$base->info(),'group'=>$group]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        Gate::authorize('update', $group);
        return view('group.edit')->with([
            'group'=>$group,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Group $group)
    {
        Gate::authorize('update', $group);
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group->fill([
            'name'=>$request->name,
        ])->save();
        return redirect()->route('group.show',$group->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        Gate::authorize('delete', $group);
        foreach($group->infoBases()->get() as $base){
            $group->deleteInfoBase($base->id);
        }
        foreach($group->roles()->get() as $role){
            $group->deleteRole($role->id);
        }
        $group->delete();
        return redirect()->route('home');
    }
    
}
