<?php

namespace App\Traits;

use App\Models\Components\Announcement;

use Illuminate\Support\Collection;
use Illuminate\Notifications\Notifiable;

trait RecieveAnnouncement
{
    use Notifiable;

    /*
    abstract public function notifications();
    abstract public function readNotifications();
    abstract public function unreadNotifications();
    */
    //
    public function announcements(){
        return $this->notifications()->where('type',\App\Notifications\Announcement::class);
    }

    //
    public function readAnnouncements(){
        return $this->readNotifications()->where('type',\App\Notifications\Announcement::class);
    }
    //
    public function unreadAnnouncements(){
        return $this->unreadNotifications()->where('type',\App\Notifications\Announcement::class);
    }
    //
    public function countUnreadAnnouncements(){
        return $this->unreadAnnouncements()->get()->count();
    }

    //
    public function getAnnouncementDatas(){
        return $this->announcements()->get()->pluck('data');
    }
    //
    public function getReadAnnouncementDatas(){
        return $this->readAnnouncements()->get()->pluck('data');
    }
    //
    public function getUnreadAnnouncementDatas(){
        return $this->unreadAnnouncements()->get()->pluck('data');
    }

    
    //
    public function getAnnouncementContents(){
        $ids=[];
        foreach($this->announcements()->get()->pluck('data') as $data){
            $ids[]=$data['id'];
        }
        return Announcement::find($ids);
    }
    //
    public function getReadAnnouncementContents(){
        $ids=[];
        foreach($this->readAnnouncements()->get()->pluck('data') as $data){
            $ids[]=$data['id'];
        }
        return Announcement::find($ids);
    }
    //
    public function getUnreadAnnouncementContents(){
        $ids=[];
        foreach($this->unreadAnnouncements()->get()->pluck('data') as $data){
            $ids[]=$data['id'];
        }
        return Announcement::find($ids);
    }
}