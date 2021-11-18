<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\User;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class RescueController extends Controller
{
    //
    public function rescue(Group $group,User $user){
        
        $user_base=$user->getInfoBaseByTemplate(config('kaigohack.rescue.user_rescue_info_template_id'));
        
        $user_info=$user_base->info();
        $group_base=$group->getInfoBaseByTemplate(config('kaigohack.rescue.group_rescue_info_template_id'));
        if($user_info->info['rescue']==config('kaigohack.rescue.rescue')){
            return response()->view('group.info.show.'.config('kaigohack.rescue.group_rescue_info_template_id'), ['base'=>$group_base,'info'=>$group_base->info(),'group'=>$group,'rescue_collision_error'=>'先に'.$user_info->info['rescuer']->name.'さんが救助に向かいました。']);
        }
        $user_base->partlyUpdateInfo([
            'rescue'=>config('kaigohack.rescue.rescue'),
            'group'=>$group,
            'rescuer'=>Auth::user(),
        ]);
        //
        return response()->view('group.info.show.'.config('kaigohack.rescue.group_rescue_info_template_id'), ['base'=>$group_base,'info'=>$group_base->info(),'group'=>$group]);
    }
    //
    public function unrescue(Group $group,User $user){
        $user->getInfoBaseByTemplate(config('kaigohack.rescue.user_rescue_info_template_id'))->partlyUpdateInfo([
            'rescue'=>config('kaigohack.rescue.unrescue'),
            'group'=>"",
            'rescuer'=>"",
        ]);
        //
        $base=$group->getInfoBaseByTemplate(config('kaigohack.rescue.group_rescue_info_template_id'));
        return response()->view('group.info.show.'.config('kaigohack.rescue.group_rescue_info_template_id'), ['base'=>$base,'info'=>$base->info(),'group'=>$group]);
    }
    //
    public function rescued(Group $group,User $user){
        $user->getInfoBaseByTemplate(config('kaigohack.rescue.user_rescue_info_template_id'))->partlyUpdateInfo([
            'rescue'=>config('kaigohack.rescue.rescued'),
            'group'=>$group,
            'rescuer'=>Auth::user(),
        ]);
        //
        $base=$group->getInfoBaseByTemplate(config('kaigohack.rescue.group_rescue_info_template_id'));
        return response()->view('group.info.show.'.config('kaigohack.rescue.group_rescue_info_template_id'), ['base'=>$base,'info'=>$base->info(),'group'=>$group]);
    }
    //
    public function reverseRescue(Group $group,User $user){
        $user->getInfoBaseByTemplate(config('kaigohack.rescue.user_rescue_info_template_id'))->partlyUpdateInfo([
            'rescue'=>config('kaigohack.rescue.unrescue'),
            'group'=>"",
            'rescuer'=>"",
        ]);
        //
        $base=$group->getInfoBaseByTemplate(config('kaigohack.rescue.group_rescue_info_template_id'));
        return response()->view('group.info.show.'.config('kaigohack.rescue.group_rescue_info_template_id'), ['base'=>$base,'info'=>$base->info(),'group'=>$group]);
    }
}
