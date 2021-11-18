<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;

use Validator;

class UploadController extends Controller
{
    //php artisan storage:linkを行う
    public function uploadImg(Request $request,$group_id){
        $validator = Validator::make($request->all(),[
            'img'=>'required|mimes:jpg,png|max:10240',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        $group->uploadImg($request->file('img'));
        return redirect()->back();
    }

    public function deleteImg(Request $request,$group_id){
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group=Group::find($group_id);
        $group->deleteImg($request->id);
        return redirect()->back();
    }
}
