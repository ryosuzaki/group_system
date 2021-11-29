<?php

namespace App\Traits;

use App\Models\Info\InfoTemplate;
use App\Models\Info\Info;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

trait UseInfo
{
    /**
     * 
     */
    public function BeforeDeleteModelUsingInfo(){
        foreach($this->infos()->get() as $info){
            $this->deleteInfo($info->id);
        }
        return true;
    }


    public static function test_constructor(Info $info){
        info($info);
    }
    /**
     * 
     */
    public function createInfo($template){
        $template=InfoTemplate::findByIdOrName($template,$this);
        //
        if($template->only_one&&$this->hasInfoBase($template)){
            //return new Exception("this info template must be only one in same model");
            return false;
        }else{
            //
            $info=$this->infos()->create([
                'index'=>$this->calcInfoIndex(),
                'info_template_id'=>$template->id,
                'name'=>$this->giveInfoName($template),
                'viewable'=>$template->default_viewable,
                'info'=>$template->default_info,
            ]);
            //
            if(isset($template->constructor)){
                $constructor=$template->constructor;
                $func=array($constructor["class"],$constructor["function"]);
                $func($info);
            }
            return $info;
        }
    }
    //
    private function giveInfoName($template){
        if($this->hasInfo($template)){
            return $template->default_name.'_'.$this->calcInfoIndex();
        }else{
            return $template->default_name;
        }
    }
    //
    private function calcInfoIndex(){
        $indexes=$this->infos()->pluck('index');
        $diff=collect(range(0,config("group_system.role.max_num_of_info_bases")-1))->diff($indexes);
        if($diff->isNotEmpty()){
            return $diff->min();
        }
    }
    //
    public function deleteInfo(int $id){
        $info=$this->getInfo($id);
        return $info->delete();
    }
    //
    public function infos(){
        return $this->morphMany('App\Models\Info\Info','model');
    }
    //
    public function getTemplates(){
        return InfoTemplate::getByModel($this);
    }
    //
    public function getInfo(int $id){
        return $this->infos()->get()->find($id);
    }
    //
    public function getInfoByTemplate($template){
        $template=InfoTemplate::findByIdOrName($template,$this);
        return $this->infos()->where('info_template_id',$template->id)->first();
    }
    //
    public function getInfos(){
        return $this->infos()->get();
    }
    //
    public function getInfosByTemplate($template){
        $template=InfoTemplate::findByIdOrName($template,$this);
        return $this->infos()->where('info_template_id',$template->id)->get();
    }
    //
    public function getInfoByIndex(int $index){
        return $this->infos()->where('index',$index)->first();
    }
    //
    public function hasInfo($template){
        if(is_string($template)||is_int($template)){
            $template=InfoTemplate::findByIdOrName($template,$this);
        }
        return $this->infos()->get()->contains('info_template_id',$template->id);
    }

    /**
     * 
     */
    public function getViewableInfos(){
        return $this->infos()->where('viewable',true)->get();
    }
}