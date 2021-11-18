<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Info\InfoTemplate;

use App\Models\Group\Group;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;

use Validator;

class GroupInfoBaseController extends Controller
{
    //
    public function index(Group $group)
    {
        Gate::authorize('viewAny-group-info-bases', $group);
        return view('group.info_base.index')->with(['group'=>$group,'bases'=>$group->infoBases()->get()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        Gate::authorize('create-group-info-bases', $group);
        return view('group.info_base.create')->with(['group'=>$group,'templates'=>InfoTemplate::where('model',get_class($group))->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Group $group)
    {
        Gate::authorize('create-group-info-bases', $group);
        $validator = Validator::make($request->all(),[
            'templates.*'=>['required', 'integer','min:1','exists:info_templates,id']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        foreach((array)$request->templates as $template){
            $group->createInfoBase($template);
        }
        return redirect()->route('group.show',$group->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group,int $id)
    {
        Gate::authorize('update-group-info-bases',$group);
        return view('group.info_base.edit')->with(['group'=>$group,'base'=>$group->getInfoBase($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Group $group,int $id)
    {
        Gate::authorize('update-group-info-bases',$group);
        $validator = Validator::make($request->all(),[
            'viewable'=>'required|boolean',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group->getInfoBase($id)->fill([
            'viewable'=>(bool)$request->viewable,
        ])->save();
        return redirect()->route('group.info_base.index',$group->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group,$id)
    {
        Gate::authorize('delete-group-info-bases', $group);
        $group->deleteInfoBase($id);
        return redirect()->back();
    }
}
