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

    @if(Illuminate\Support\Facades\View::exists('group.show.'.$group->getTypeName()))
    @include('group.show.'.$type->name, ['group'=>$group,'bases'=>$bases])
    @else

    @endif

    @can('update',$group)
    <div class="row">
        <a class="btn btn-primary btn-block" href="{{route('group.edit',[$group->id])}}">変更/削除</a>
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
    @foreach ($bases as $base)
    $("a[href='#pill{{$base->index}}']").click(function(){
        window.history.replaceState(null,null,"{{route('group.show',['group'=>$group,'index'=>$base->index])}}");
        embed_info_view("get","{{route('group.get_info',['group'=>$group,'index'=>$base->index])}}","#embed_info{{$base->index}}");
    });
    @endforeach
});
</script>

<div class="card mt-0 mb-2">
    <div class="card-body">
        <ul class="nav nav-pills nav-pills-primary">
            @foreach ($bases as $base)
            <li class="nav-item mx-auto">
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
                @can('update-group-info',[$group,$base->index])
                @if(!empty($template->edit))
                <div class="d-flex">
                    <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('group.info.edit',[$group->id,$base->index])}}">{!! $template->edit['icon'] !!} {{$template->edit['name']}}</a>
                </div>
                @endif
                @endcan
            </div>
            @endforeach

        </div>
        @can('viewAny-group-info-bases', $group)
        <div class="row">
            <a class="btn btn-primary btn-block" href="{{route('group.info_base.index',[$group->id])}}"><i class="material-icons">list</i> 情報編集</a>
        </div>
        @endcan
    </div>
    
</div>
    


@endsection