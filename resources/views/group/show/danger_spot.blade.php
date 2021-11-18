@php
$extra_name='good';
$extra_name_jp=config('kaigohack.'.$extra_name);
@endphp

<div class="d-flex">
    <div class="ml-auto">
        @if(Auth::user()->hasGroup($group->id))
        <a class="btn btn-outline-primary btn-round btn-sm text-primary"><i class="material-icons">thumb_up_off_alt</i>{{$group->countExtraUsers($extra_name)}}</a>
        @else
        <a class="btn btn-warning btn-sm" href=""><i class="material-icons">campaign</i>通報</a>
        <script type="module">
            $(function(){
                //
                $("#set_extra_group_{{$extra_name}}").click(function(){
                    $.ajax({
                        type:"get", 
                        url:"{{route('group.extra_group.set',[$group,$extra_name])}}",
                        dataType: 'json',
                    })
                    .done((response)=>{
                        $("#set_extra_group_{{$extra_name}}").addClass("d-none");
                        $("#unset_extra_group_{{$extra_name}}").removeClass("d-none");
                        $(".count_extra_group_{{$extra_name}}").text(response.count);
                    })
                    .fail((error)=>{
                        console.log(error)
                    })
                });
                //
                $("#unset_extra_group_{{$extra_name}}").click(function(){
                    $.ajax({
                        type:"get", 
                        url:"{{route('group.extra_group.unset',[$group,$extra_name])}}",
                        dataType: 'json',
                    })
                    .done((response)=>{
                        $("#set_extra_group_{{$extra_name}}").removeClass("d-none");
                        $("#unset_extra_group_{{$extra_name}}").addClass("d-none");
                        $(".count_extra_group_{{$extra_name}}").text(response.count);
                    })
                    .fail((error)=>{
                        console.log(error)
                    })
                });
                //
                @if(Auth::user()->hasExtraGroup($group->id,$extra_name))
                $("#set_extra_group_{{$extra_name}}").addClass("d-none");
                @else
                $("#unset_extra_group_{{$extra_name}}").addClass("d-none");
                @endif
            });
        </script>
        <button class="btn btn-primary btn-round btn-sm" id="unset_extra_group_{{$extra_name}}"><i class="material-icons">thumb_up_off_alt</i><span class="count_extra_group_{{$extra_name}}">{{$group->countExtraUsers($extra_name)}}</span></button>
            
        <button class="btn btn-outline-primary btn-round btn-sm" id="set_extra_group_{{$extra_name}}"><i class="material-icons">thumb_up_off_alt</i><span class="count_extra_group_{{$extra_name}}">{{$group->countExtraUsers($extra_name)}}</span></button>
        @endif
    </div>
</div>


<h3 class="text-center my-3">{{$group->name}}</h3>

@php
$imgs=$group->getImgs();
@endphp
<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i=0;$i<count($imgs);$i++)
        <li data-target="#carousel" data-slide-to="{{$i}}" @if($i==0) class="active" @endif></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach($imgs as $img)
        <div class="carousel-item @if($imgs[0]==$img) active @endif">
            <img class="d-block w-100" src="{{$img->getUrl()}}">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<form action="{{route('group.uploadImg',$group->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="d-flex">
        <div class="form-group form-file-upload form-file-multiple w-75">
            <input type="file" name="img" multiple="" accept="image/*" class="inputFileHidden">
            <div class="input-group">
                <input type="text" class="form-control inputFileVisible" placeholder="写真を選択">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-fab btn-round btn-primary">
                        <i class="material-icons">add_photo_alternate</i>
                    </button>
                </span>
            </div>
        </div>
        <div class="pt-3">
            <button type="submit" class="btn btn-round btn-primary mb-2 w-100">投稿</button>
        </div>
    </div>
</form>

@if(Auth::user()->hasGroup($group->id))
<form action="{{route('group.deleteImg',$group->id)}}" method="post">
    @csrf
    @method('DELETE')
    <div class="d-flex">
        <div class="form-group w-75">
            <select class="form-control selectpicker" data-style="btn btn-link" id="deleteImg" name="id">
                @for($i=0;$i<count($imgs);$i++)
                <option value="{{$imgs[$i]->id}}">左から{{$i+1}}枚目の写真</option>
                @endfor
            </select>
        </div>
        <div class="">
            <button type="submit" class="btn btn-round btn-danger mb-2 w-100">削除</button>
        </div>
    </div>
</form>
@endif


<div class="d-flex justify-content-center mt-4 mb-3">
    @if($group->isLocationSet())
    <div>
        <a class="btn btn-outline-primary btn-round btn-sm" href="{{route('group.location.show',$group->id)}}"><i class="material-icons">location_on</i> マップに表示</a>
    </div>
    @else
    <div>
        <a class="btn btn-secondary btn-round btn-sm disabled"><i class="material-icons">location_on</i> 地点未設定</a>
    </div>
    @endif
</div>
    
