<?php

namespace App\Models\Components;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Notification;

class Announcement extends Model
{
    //
    protected $guarded = ['id'];

    //
    public function model(){
        return $this->morphTo();
    }

    //
    public function send($users){
        return Notification::send($users,new \App\Notifications\Announcement([
            'model'=>$this->model()->first(),
            'announcement'=>$this,
        ]));
    }
}
