<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Info\Info;
use App\Models\Info\InfoBase;

class UserInfoController extends Controller
{
    //
    public function edit(InfoBase $info_base)
    {
        return view('user.info.edit')->with([
            'base'=>$info_base,
            'info'=>$info_base->info(),
            ]);
    }

    //
    public function update(Request $request,InfoBase $info_base)
    {
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $info_base->updateInfo($request->toArray()['info']); 
        return redirect()->route('user.show',$info_base->index);
    }
}
