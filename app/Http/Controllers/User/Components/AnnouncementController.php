<?php

namespace App\Http\Controllers\User\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Notifications\DatabaseNotification;

use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    //
    public function index(){
        return view('user.components.announcement.index')->with([
            'user'=>Auth::user(),
            'announcements'=>Auth::user()->announcements()->get(),
        ]);
    }

    //
    public function show(DatabaseNotification $announcement){
        $announcement->markAsRead();
        return view('user.components.announcement.show')->with([
            'user'=>Auth::user(),
            'announcement'=>$announcement,
        ]);
    }

    //
    public function markAsReadAll(){
        Auth::user()->unreadAnnouncements()->get()->markAsRead();
        return redirect()->back();
    }

    //
    public function destroy(string $id){
        Auth::user()->announcements()->find($id)->delete();
        return redirect()->back();
    }
}
