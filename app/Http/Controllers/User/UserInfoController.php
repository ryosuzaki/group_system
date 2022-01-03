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
    public function edit(int $index)
    {
        $user=Auth::user();
        $info=$user->getInfoByIndex($index);
        return view('user.info.edit')->with([
            "user"=>$user,
            'info'=>$info,
            "template"=>$info->template,
            'index'=>$index,
            ]);
    }
}
