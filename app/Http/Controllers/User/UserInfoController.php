<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Info\Info;

class UserInfoController extends Controller
{
    /**
     * 
     */
    public function getInfoView(int $index=0)
    {
        $user=Auth::user();
        $info=$user->getInfoByIndex($index);
        return response()->view($info->getTemplate()->view["show"]["path"], ['info'=>$info,"user"=>$user]);
    }
    
    /**
     * 
     */
    public function edit(int $index)
    {
        $user=Auth::user();
        $info=$user->getInfoByIndex($index);
        return view('user.info.edit')->with([
            "user"=>$user,
            'info'=>$info,
            "template"=>$info->getTemplate(),
            'index'=>$index,
            ]);
    }
}
