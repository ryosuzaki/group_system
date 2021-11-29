<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Info\InfoTemplate;
use App\User;

use Illuminate\Support\Facades\Auth;

use Validator;

class UserInfosController extends Controller
{
    //
    public function index()
    {
        $user=Auth::user();
        return view('user.infos.index')->with(['user'=>$user,'infos'=>$user->getInfos()]);
    }

    //
    public function create()
    {
        $user=Auth::user();
        return view('user.infos.create')->with(['user'=>$user,'templates'=>InfoTemplate::getByModel($user)]);
    }

    /**
     * 
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'templates.*'=>['required', 'integer','min:1','exists:info_templates,id']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        foreach((array)$request->templates as $template){
            Auth::user()->createInfo($template);
        }
        return redirect()->route('user.show');
    }

    /**
     * 
     */
    public function edit(int $index)
    {
        $user=Auth::user();
        $info=$user->getInfoByIndex($index);
        return view('user.infos.edit')->with(['user'=>$user,'info'=>$info]);
    }

    /**
     * 
     */
    public function update(Request $request,int $index)
    {
        $validator = Validator::make($request->all(),[
            'viewable'=>'required|boolean',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user=Auth::user();
        $info=$user->getInfoByIndex($index);
        $info->fill([
            'viewable'=>(bool)$request->viewable,
        ])->save();
        return redirect()->route('user.infos.index',$user->id);
    }

    /**
     * 
     */
    public function destroy(int $index)
    {
        $user=Auth::user();
        $info=$user->getInfoByIndex($index);
        $user->deleteInfo($info->id);
        return redirect()->back();
    }
}
