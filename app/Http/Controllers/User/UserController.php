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
    //
    public function show(int $index=0)
    {
        return view('user.show')->with([
            'bases'=>Auth::user()->infoBases()->get(),
            'index'=>$index,
            ]);
    }

    //
    public function getInfo(int $index=0)
    {
        $base=Auth::user()->getInfoBaseByIndex($index);
        return response()->view('user.info.show.'.$base->info_template_id, ['base'=>$base,'info'=>$base->info()]);
    }

    //
    public function edit()
    {
        return view('user.edit')->with(['user'=>Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

    //
    public function initialSettingForm(){
        return view('user.initial_setting')->with(['types'=>GroupType::all()]);
    }
    //
    public function initialSetting(Request $request){
        $validator = Validator::make($request->all(),[
            'types.*' => ['required', 'integer','min:1','exists:group_types,id'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        foreach ((array)$request->types as $type){
            Auth::user()->useGroupType((int)$type);
        }
        return redirect()->route('user.show');
    }

}
