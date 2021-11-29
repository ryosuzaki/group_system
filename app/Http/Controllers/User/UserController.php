<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Group\GroupType;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * 
     */
    public function show(int $index=0)
    {
        $user=Auth::user();
        return view('user.show')->with([
            "user"=>$user,
            'infos'=>$user->getInfos(),
            'index'=>$index,
            ]);
    }

    /**
     * 
     */
    public function getInfo(int $index=0)
    {
        $user=Auth::user();
        $info=$user->getInfoByIndex($index);
        return response()->view($info->getTemplate()->view["show"]["path"], ['info'=>$info,"user"=>$user]);
    }
    
    /**
     * 
     */
    public function edit()
    {
        return view('user.edit')->with(['user'=>Auth::user()]);
    }

    /**
     * 
     */
    public function update(Request $request)
    {
        $user=Auth::user();
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users','email')->ignore($user)],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user->fill([
            'name'=>$request['name'],
            'email'=>$request['email'],
        ])->save();
        return redirect()->route('user.show');
    }

    /**
     * 
     */
    public function destroy()
    {
        Auth::user()->tearDown();
        return redirect()->route('home');
    }
}
