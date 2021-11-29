<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Info\Info;

use Illuminate\Support\Facades\Gate;

use App\Models\Group\Group;

class GroupInfoController extends Controller
{
    //
    public function edit(Group $group,int $index)
    {
        Gate::authorize('update-group-info',[$group,$index]);
        $info=$group->getInfoByIndex($index);
        return view('group.info.edit')->with([
            'group'=>$group,
            'template'=>$info->getTemplate(),
            'info'=>$info,
            'index'=>$index,
            ]);
    }
}
