<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\User;

use Illuminate\Support\Facades\Auth;

class ExtraGroupController extends Controller
{
    //
    public function set(Group $group,string $extra_name){
        Auth::user()->attachExtraGroup($group->id,$extra_name);
        return response()->json(["count"=>$group->countExtraUsers($extra_name)]);
    }
    //
    public function unset(Group $group,string $extra_name){
        Auth::user()->detachExtraGroup($group->id,$extra_name);
        return response()->json(["count"=>$group->countExtraUsers($extra_name)]);
    }
}
