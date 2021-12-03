<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Group\GroupType;

class HomeController extends Controller
{
    //
    public function index(){
        return view('home')->with(['types'=>GroupType::all()]);
    }
}
