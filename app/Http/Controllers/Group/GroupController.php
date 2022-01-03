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
    public function home(GroupType $type){
        return view("group.home")->with(['type'=>$type]);
    }

    //
    public function index(GroupType $type)
    {
        Gate::authorize('viewAny', [Group::class,$type]);
        return view('group.index')->with(['type'=>$type]);
    }

    //
    public function create(GroupType $type)
    {
        Gate::authorize('create', [Group::class,$type]);
        return view('group.create')->with(['type'=>$type]);
    }

    //
    public function store(Request $request,GroupType $type)
    {
        Gate::authorize('create', [Group::class,$type]);
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::setUp(Auth::user(),$request->name,$type,$request->password);
        return redirect()->route('group.show',$group->id);
    }

    /*
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
    */

    /**
     * 
     */
    public function show(Group $group,int $index=0)
    {
        $user=Auth::user();
        if($user->hasGroup($group->id)){
            $infos=$group->getViewableInfosByRole($user->getRoleByGroup($group->id));
        }else{
            $infos=$group->getViewableInfos();
        }
        return view('group.show')->with([
            'group'=>$group,
            'type'=>$group->type,
            'infos'=>$infos,
            'index'=>$index,
            ]);
    }

    /**
     * 
     */
    public function getInfo(Group $group,int $index=0)
    {
        Gate::authorize('view-group-info',[$group,$index]);
        $info=$group->getInfoByIndex($index);
        return response()->view($info->template->view["show"]["path"], ['info'=>$info,'group'=>$group]);
    }

    

    /**
     * 
     */
    public function edit(Group $group)
    {
        Gate::authorize('update', $group);
        return view('group.edit')->with([
            'group'=>$group,
            ]);
    }

    /**
     * 
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
     * 
     */
    public function destroy(Group $group)
    {
        Gate::authorize('delete', $group);
        $group->tearDown();
        return redirect()->route('home');
    }
    
}
