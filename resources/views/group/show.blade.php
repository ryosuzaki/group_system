@extends('template')

@section('content')


<div class="card mb-3">

    {{ Breadcrumbs::render('group.show',$group) }}

    <div class="card-body">
    <div class="d-flex">
        <div class="ml-auto">
            @can('viewAny-group-roles',$group)
            <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.role.index',$group->id)}}"><i class="material-icons">assignment_ind</i>　役割</a>
            @endcan
        </div>
    </div>

    <!--config/group_system.types.view.show.pathのviewがはめ込まれる-->
    @if(isset($type->view["show"]["path"]))
    @include($type->view["show"]["path"], ['group'=>$group,'infos'=>$infos])
    @else

    @endif

    @can('update',$group)
    <div class="row">
        <a class="btn btn-primary btn-block" href="{{route('group.edit',[$group->id])}}"><i class="material-icons">settings</i> 変更</a>
    </div>
    @endcan

    </div>
</div>

<script type="module">
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
    window.history.replaceState(null,null,"{{route('group.show',['group'=>$group,'index'=>$index])}}");
    embed_info_view("get","{{route('group.get_info',['group'=>$group,'index'=>$index])}}","#embed_info{{$index}}");
    @foreach ($infos as $info)
    $("a[href='#pill{{$info->index}}']").click(function(){
        window.history.replaceState(null,null,"{{route('group.show',['group'=>$group,'index'=>$info->index])}}");
        embed_info_view("get","{{route('group.get_info',['group'=>$group,'index'=>$info->index])}}","#embed_info{{$info->index}}");
    });
    @endforeach
});
</script>

<div class="card mt-0 mb-2">
    <div class="card-body">
        <ul class="nav nav-pills nav-pills-primary">
            @foreach ($infos as $info)
            <li class="nav-item mx-auto">
                <a class="nav-link @if($info->index==$index) active @endif" href="#pill{{$info->index}}" data-toggle="tab">{{$info->name}}</a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content tab-space pb-0">
            @foreach ($infos as $info)
            @php
            $template=$info->getTemplate();
            @endphp
            <div class="tab-pane @if($info->index==$index) active @endif" id="pill{{$info->index}}">
                <div id="embed_info{{$info->index}}"></div>
                @can('update-group-info',[$group,$info->index])
                @if(!empty($template->edit))
                <div class="d-flex">
                    <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('group.info.edit',[$group->id,$info->index])}}">{!! $template->edit['icon'] !!} {{$template->edit['name']}}</a>
                </div>
                @endif
                @endcan
            </div>
            @endforeach

        </div>
        @can('viewAny-group-infos', $group)
        <div class="row">
            <a class="btn btn-primary btn-block" href="{{route('group.infos.index',[$group->id])}}"><i class="material-icons">list</i> 情報編集</a>
        </div>
        @endcan
    </div>
    
</div>
    


@endsection