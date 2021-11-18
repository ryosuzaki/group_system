
@php
$extra_name='good';
$extra_name_jp=config('kaigohack.'.$extra_name);
@endphp

<div class="d-flex justify-content-around">
    <p class="h4 mr-auto">危険地点</p>
    <div class="ml-auto">
        @if(Auth::user()->hasGroup($group->id))
        <a class="btn btn-outline-primary btn-round btn-sm text-primary"><i class="material-icons m-0" style="font-size: 1.5rem;">thumb_up_off_alt</i>{{$group->countExtraUsers($extra_name)}}</a>
        @else
        <a class="btn btn-warning btn-sm" href=""><i  class="material-icons m-0" style="font-size: 1.5rem;">campaign</i>通報</a>
        <script>
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
        <button class="btn btn-primary btn-round btn-sm" id="unset_extra_group_{{$extra_name}}"><i class="material-icons m-0" style="font-size: 1.5rem;">thumb_up_off_alt</i><span class="count_extra_group_{{$extra_name}}">{{$group->countExtraUsers($extra_name)}}</span></button>
            
        <button class="btn btn-outline-primary btn-round btn-sm" id="set_extra_group_{{$extra_name}}"><i class="material-icons m-0" style="font-size: 1.5rem;">thumb_up_off_alt</i><span class="count_extra_group_{{$extra_name}}">{{$group->countExtraUsers($extra_name)}}</span></button>
        @endif
    </div>
</div>

<div class="d-flex justify-content-center"><a href="{{route("group.show",$group->id)}}" class="h3 text-center">{{$group->name}}<i class="material-icons" >launch</i></a></div>


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




<script>
function embed_info_view(type,url,embed_to){
    $.ajax({
        type:type, 
        url:url,
        dataType: 'html',
    })
    .done((response)=>{
        $(embed_to).html(response);
    })
    .fail((error)=>{
        console.log(error)
    })
}
$(function(){
    embed_info_view("get","{{route('group.get_info',['group'=>$group,'index'=>$index])}}","#embed_info{{$index}}");
    @foreach ($bases as $base)
    $("a[href='#pill{{$base->index}}']").click(function(){
        embed_info_view("get","{{route('group.get_info',['group'=>$group,'index'=>$base->index])}}","#embed_info{{$base->index}}");
    });
    @endforeach
});
</script>

<div class="border-top mt-3">
    <ul class="nav nav-pills nav-pills-primary">
        @foreach ($bases as $base)
        <li class="nav-item mx-auto mt-3">
            <a class="nav-link @if($base->index==$index) active @endif" href="#pill{{$base->index}}" data-toggle="tab">{{$base->name}}</a>
        </li>
        @endforeach
    </ul>
    
    <div class="tab-content tab-space pb-0">
        @foreach ($bases as $base)
        @php
        $template=$base->getTemplate();
        @endphp
        <div class="tab-pane @if($base->index==$index) active @endif" id="pill{{$base->index}}">
            <div id="embed_info{{$base->index}}"></div>
        </div>
        @endforeach
    </div>
</div>
