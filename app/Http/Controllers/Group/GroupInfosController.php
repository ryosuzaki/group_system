<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Info\InfoTemplate;
use App\Models\Info\Info;

use App\Models\Group\Group;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;

use Validator;

class GroupInfosController extends Controller
{
    //
    public function index(Group $group)
    {
        Gate::authorize('viewAny-group-infos', $group);
        return view('group.infos.index')->with(['group'=>$group,'infos'=>$group->getInfos()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        Gate::authorize('create-group-infos', $group);
        return view('group.infos.create')->with(['group'=>$group,'templates'=>InfoTemplate::getByModel($group)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Group $group)
    {
        Gate::authorize('create-group-infos', $group);
        $validator = Validator::make($request->all(),[
            'templates.*'=>['required', 'integer','min:1','exists:info_templates,id']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        foreach((array)$request->templates as $template){
            $group->createInfo((int)$template);
        }
        return redirect()->route('group.show',$group->id);
    }

    /**
     * 
     */
    public function edit(Group $group,int $index)
    {
        Gate::authorize('update-group-infos',$group);
        $info=$group->getInfoByIndex($index);
        return view('group.infos.edit')->with(['group'=>$group,'info'=>$info]);
    }

    /**
     * 
     */
    public function update(Request $request,Group $group,int $index)
    {
        Gate::authorize('update-group-infos',$group);
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'viewable'=>'required|boolean',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $info=$group->getInfoByIndex($index);
        $info->setName($request->name);
        $info->setViewable((bool)$request->viewable);
        return redirect()->route('group.infos.index',$group->id);
    }

    /**
     * 
     */
    public function destroy(Group $group,int $index)
    {
        Gate::authorize('delete-group-infos', $group);
        $info=$group->getInfoByIndex($index);
        $group->deleteInfo($info->id);
        return redirect()->back();
    }
}
