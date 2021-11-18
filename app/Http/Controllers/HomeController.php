<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Group\GroupType;

class HomeController extends Controller
{
    //
    public function index(){
        return view('home.home')->with(['types'=>GroupType::all()]);
    }
    //
    public function groupType(GroupType $group_type){
        return view('home.group_type.'.$group_type->name)->with(['type'=>$group_type]);
    }
}
