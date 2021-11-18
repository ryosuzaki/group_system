<?php

namespace App\Traits;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

trait UseLocation
{
    //
    public function location(){
        return $this->morphOne('App\Models\Components\Location', 'model');
    }
    //
    public function getLocation(){
        return $this->location()->first();
    }
    //
    public function setLocation(float $latitude,float $longitude){
        $location=$this->getLocation();
        if(isset($location)){
            return $location->fill([
                'latitude'=>$latitude,
                'longitude'=>$longitude,
            ])->save();
        }else{
            return $this->location()->create([
                'latitude'=>$latitude,
                'longitude'=>$longitude,
            ]);
        }
    }
    //
    public function isLocationSet(){
        return ($this->getLocation()->latitude||$this->getLocation()->longitude)?true:false;
    }
}