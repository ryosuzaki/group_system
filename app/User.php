<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

use App\Traits\UseInfo;
use App\Traits\UseRoleInUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use UseInfo;
    use UseRoleInUser;

    //
    protected $guarded=["id"];

    //
    protected $hidden = [
         'remember_token','password'
    ];

    //
    public static function findByEmail(string $email){
        return parent::where('email',$email)->first();
    }

    //
    public static function setUp(string $name,string $email,string $password){
        $user=User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        return $user;
    }

    public function tearDown(){
        $this->BeforeDeleteModelUsingInfo();
        return $this->delete();
    }
    


    //
    public function groups(){
        return $this->modelsUsingRole(Group::class);
    }
    //
    public function hasGroup(int $id){
        return $this->hasModelUsingRole(Group::class,$id);
    }
    //
    public function getGroup(int $id){
        return $this->getModelUsingRole(Group::class,$id);
    }




    //
    public function joinGroup(int $group_id,$role,string $password){
        return $this->joinModelRole(Group::class,$group_id,$role,$password);
    }
    //
    public function leaveGroup(int $group_id){
        return $this->leaveModelRole(Group::class,$group_id);
    }


    //
    public function hasRoleInGroup($role,int $group_id){
        return $this->hasRoleInModel($role,Group::class,$group_id);
    }
    //
    public function getRoleByGroup(int $group_id){
        return $this->getRoleByModel(Group::class,$group_id);
    }
    
    //
    public function rolesThroughGroup(){
        return $this->rolesThroughModel(Group::class);
    }
    
    //
    public function groupsHaveType($type){
        $type=GroupType::findByIdOrName($type);
        $out=[];
        foreach($this->groups()->get() as $group){
            if($group->group_type_id==$type->id){
                $out[]=$group;
            }
        }
        return collect($out);
    }

    //
    public function groupTypes(){
        $types=[];
        foreach($this->groups()->get() as $group){
            $types[]=$group->type;
        }
        return collect(array_unique($types));
    }
    /*
    public function useGroupType($type){
        $type=GroupType::findByIdOrName($type);
        $ids=collect($type->user_info)->diff($this->infoBases()->pluck('info_template_id'));
        foreach($ids as $id){
            $this->createInfoBase($id);
        }
        return $ids;
    }*/




    
    //
    public function groupsRequestJoin(){
        return $this->modelsRequestJoin(Group::class);
    }
    //
    public function countGroupsRequestJoin(){
        return $this->countModelsRequestJoin(Group::class);
    }

    //
    public function acceptGroupJoinRequest(int $group_id){
        return $this->acceptModelJoinRequest(Group::class,$group_id);
    }
    //
    public function deniedGroupJoinRequest(int $group_id){
        return $this->deniedModelJoinRequest(Group::class,$group_id);
    }
}
