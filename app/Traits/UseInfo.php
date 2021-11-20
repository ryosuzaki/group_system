<?php

namespace App\Traits;

use App\Models\Info\InfoTemplate;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

trait UseInfo
{
    /**
     * 
     */
    public function BeforeDeleteModelUsingInfo(){
        foreach($this->infoBases()->get() as $base){
            $this->deleteInfoBase($base->id);
        }
        return true;
    }
    /**
     * 
     */
    public function createInfoBase($template){
        $template=InfoTemplate::findByIdOrName($template,$this);
        if($template->only_one&&$this->hasInfoBase($template)){
            return new Exception("this info template must be only one in same model");
        }else{
            $base=$this->infoBases()->create([
                'index'=>$this->calcInfoBaseIndex(),
                'info_template_id'=>$template->id,
                'name'=>$this->giveInfoBaseName($template),
                'edit'=>$template->default_edit,
                'viewable'=>$template->default_viewable,
            ]);
            $base->infos()->create([
                'info'=>$template->default_info,
            ]);
            return $base;
        }
    }
    //
    private function giveInfoBaseName($template){
        if($this->hasInfoBase($template)){
            return $template->default_name.'_'.$this->calcInfoBaseIndex();
        }else{
            return $template->default_name;
        }
    }
    //
    private function calcInfoBaseIndex(){
        $indexes=$this->infoBases()->pluck('index');
        $diff=collect(range(0,config("group_system.role.max_num_of_info_bases")-1))->diff($indexes);
        if($diff->isNotEmpty()){
            return $diff->min();
        }
    }
    //
    public function deleteInfoBase(int $base_id){
        $base=$this->infoBases()->find($base_id);
        $base->infos()->delete();
        return $base->delete();
    }
    //
    public function infoBases(){
        return $this->morphMany('App\Models\Info\InfoBase','model');
    }
    //
    public function getTemplates(){
        return InfoTemplate::getByModel($this);
    }
    //
    public function getInfoBase(int $id){
        return $this->infoBases()->get()->find($id);
    }
    //
    public function getInfoBaseByTemplate($template){
        $template=InfoTemplate::findByIdOrName($template,$this);
        return $this->infoBases()->where('info_template_id',$template->id)->first();
    }
    //
    public function getInfoBases(){
        return $this->infoBases()->get();
    }
    //
    public function getInfoBasesByTemplate($template){
        $template=InfoTemplate::findByIdOrName($template,$this);
        return $this->infoBases()->where('info_template_id',$template->id)->get();
    }
    //
    public function getInfoBaseByIndex(int $index){
        return $this->infoBases()->where('index',$index)->first();
    }
    //
    public function hasInfoBase($template){
        $template=InfoTemplate::findByIdOrName($template,$this);
        return $this->infoBases()->get()->contains('info_template_id',$template->id);
    }


    //
    public function updateInfo(int $base_id,array $info){
        return $this->infoBases()->find($base_id)->updateInfo($info);
    }
    //
    public function infos(){
        $infos=[];
        foreach($this->infoBases()->get() as $base){
            $infos[]=$base->info();
        }
        return collect($infos);
    }
    //
    public function info(int $id){
        return $this->getInfoBase($id)->info();
    }
    //
    public function getInfoByTemplate($template){
        return $this->getInfoBaseByTemplate($template)->info();
    }
    //
    public function getInfoByIndex(int $index){
        return $this->getInfoBaseByIndex($index)->info();
    }
    //
    public function infoLogs(int $base_id){
        return $this->infoBases()::find($base_id)->infos()->get();
    }
    //
    public function infoAndBasePairs(){
        return [
            'bases'=>$this->infoBases()->get(),
            'infos'=>$this->infos()->get(),
        ];
    }
    //
    public function infoAndBasePair(int $id){
        $base=$this->getInfoBase($id);
        return [
            'base'=>$base,
            'info'=>$base->info(),
        ];
    }
}