@php
$extra_name='check';
$extra_name_jp=config('kaigohack.'.$extra_name);
@endphp
<div class="d-flex">
    <div class="ml-auto">
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
        <button class="btn btn-primary btn-round btn-sm" id="unset_extra_group_{{$extra_name}}"><i class="material-icons">check</i><span> {{$extra_name_jp}}中</span></button>
            
        <button class="btn btn-outline-primary btn-round btn-sm" id="set_extra_group_{{$extra_name}}"><i class="material-icons">check</i><span> {{$extra_name_jp}}する</span></button>
    </div>
</div>
<h3 class="text-center">{{$group->name}}</h3>
<h6 class="text-center"><span class="count_extra_group_{{$extra_name}}">{{$group->countExtraUsers($extra_name)}}</span>人が{{$extra_name_jp}}中</h6>
@php
$degree=$group->getInfoByTemplate(config('kaigohack.shelter.group_congestion_info_template_id'))->info['degree'];
$color=$group->getInfoByTemplate(config('kaigohack.shelter.group_congestion_info_template_id'))->info['color'];
@endphp
<div class="row"><p class="h5 mx-auto">混雑度：<strong>{{$degree}}%</strong></p></div>

<div class="progress">
    <div class="progress-bar" role="progressbar" style="width:{{$degree}}%;background-color:{{$color}};" aria-valuenow={{$degree}} aria-valuemin="0" aria-valuemax="100">
    </div>
</div>


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