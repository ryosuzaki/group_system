<?php

namespace App\Models\Components;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $guarded = ['id'];

    //
    public function getLocationAttribute()
    {
        return [
                'longitude'=>$this->longitude,
                'latitude'=>$this->latitude,
        ];
    }

    //
    public function model()
    {
        return $this->morphTo();
    }
}
