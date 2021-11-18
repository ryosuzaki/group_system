<?php

namespace App\Traits;

use App\Models\Upload\Image;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

trait UploadImg
{
    //
    public function images(){
        return $this->morphMany('App\Models\Upload\Image','model');
    }
    //
    public function getImgs(){
        return $this->images()->get();
    }
    //
    public function getImgUrls(){
        $urls=[];
        foreach($this->images()->get() as $img){
            $urls[]=$img->getUrl();
        }
        return $urls;
    }
    //
    public function uploadImg(UploadedFile $img,string $dir){
        return $this->images()->create([
            'path'=>$img->store('public/'.$dir),
        ]);
    }
    //
    public function deleteImg(int $id){
        $img=Image::find($id);
        Storage::delete($img->path);
        return $this->images()->find($id)->delete();
    }
}