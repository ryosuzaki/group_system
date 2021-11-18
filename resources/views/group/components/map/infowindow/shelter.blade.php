@php
$extra_name='check';
$extra_name_jp=config('kaigohack.'.$extra_name);
@endphp
<div class="d-flex justify-content-around">
    <p class="h4 mr-auto">避難所</p>
</div>

<div class="d-flex justify-content-center"><a href="{{route("group.show",$group->id)}}" class="h3 text-center my-3">{{$group->name}}<i class="material-icons" >launch</i></a></div>

<div>
    @php
    $congestion_info=$group->getInfoByTemplate(config('kaigohack.shelter.group_congestion_info_template_id'));
    @endphp
    <p class="h4 text-center">混雑度：{{$congestion_info->info['degree']}}%</p>
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width:{{$congestion_info->info['degree']}}%;background-color:{{$congestion_info->info['color']}};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
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
    <button class="btn btn-primary btn-round py-2 px-3" id="unset_extra_group_{{$extra_name}}"><i class="material-icons m-0" style="font-size: 1.5rem;">check</i><span> {{$extra_name_jp}}中</span></button>

    <button class="btn btn-outline-primary btn-round py-2 px-3" id="set_extra_group_{{$extra_name}}"><i class="material-icons m-0" style="font-size: 1.5rem;">check</i><span> {{$extra_name_jp}}する</span></button>

    <button id="guide_route" class="btn btn-info btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">directions</i>経路案内</button>
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
    
    <div class="tab-content tab-space pb-3">
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


            
            