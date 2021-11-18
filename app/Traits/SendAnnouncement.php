<?php

namespace App\Traits;

use App\Models\Components\Announcement;

use Illuminate\Support\Collection;

trait SendAnnouncement
{
    //
    public function sendAnnouncement($users,string $title,string $content){
        return $this->announcements()->create([
            'title' => $title,
            'content' => $content,
        ])->send($users);
    }
    //
    public function announcements(){
        return $this->morphMany('App\Models\Components\Announcement', 'model');
    }
}