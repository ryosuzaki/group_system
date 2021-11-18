<?php

namespace App\Models\Upload;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Wildside\Userstamps\Userstamps;

class Image extends Model
{
    use Userstamps;
    //
    protected $guarded=['id'];



    //
    public function model(){
        return $this->morphTo();
    }

    //
    public function getUrl(){
        return Storage::url($this->path);
    }
}
