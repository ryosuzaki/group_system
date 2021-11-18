<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    //
    public function mapMultipleTypes($types=[]){
        $groups=[];
        foreach($types as $type){
            $tmp_groups=GroupType::findByIdOrName($type)->groups()->get();
            foreach($tmp_groups as $group){
                if($group->isLocationSet()){
                    $groups[]=$group;
                }
            }
        }
        return view('group.components.map.map')->with(["groups"=>$groups]);
    }
    //
    public function getInfoWindowHtml(Group $group){
        if(Auth::user()->hasGroup($group->id)){
            $bases=$group->getViewableInfoBasesByRole(Auth::user()->getRoleByGroup($group->id)->id);
        }else{
            $bases=$group->getViewableInfoBases();
        }
        return response()->view('group.components.map.infowindow.'.$group->getTypeName(), [
            'group'=>$group,
            'type'=>$group->getType(),
            'bases'=>$bases,
            'index'=>0,
        ]);
    }
    //
    public function mapShelterAndDangerSpot(){
        $types=["shelter","danger_spot"];
        $groups=[];
        foreach($types as $type){
            $tmp_groups=GroupType::findByIdOrName($type)->groups()->get();
            foreach($tmp_groups as $group){
                if($group->isLocationSet()){
                    $groups[]=$group;
                }
            }
        }
        return view('group.components.map.disaster_map')->with(["groups"=>$groups]);
    }
}
