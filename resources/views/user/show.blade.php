@extends('template')

@section('content')


<div class="card mb-3">
{{ Breadcrumbs::render('user.show') }}
    <div class="card-body">
        <h3 class="text-center">{{Auth::user()->name}}</h3>
        <p class="h3 text-center">{{Auth::user()->email}}</p>
        <div class="row">
            <a class="btn btn-primary btn-block" href="{{route('user.edit')}}"><i class="material-icons">edit</i> 変更</a>
        </div>
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
    window.history.replaceState(null,null,"{{route('user.show',['index'=>$index])}}");
    embed_info_view("get","{{route('user.get_info',['index'=>$index])}}","#embed_info{{$index}}");
    @foreach ($bases as $base)
    $("a[href='#pill{{$base->index}}']").click(function(){
        window.history.replaceState(null,null,"{{route('user.show',['index'=>$base->index])}}");
        embed_info_view("get","{{route('user.get_info',['index'=>$base->index])}}","#embed_info{{$base->index}}");
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
        <div class="tab-content tab-space pb-3">
            @foreach ($bases as $base)
            @php
            $template=$base->getTemplate();
            @endphp
            <div class="tab-pane @if($base->index==$index) active @endif" id="pill{{$base->index}}">
                <div id="embed_info{{$base->index}}"></div>
                <div class="d-flex">
                    <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('user.info.edit',$base->id)}}">{!! $template->edit['icon'] !!} {{$template->edit['name']}}</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <a class="btn btn-primary btn-block" href="{{route('user.info_base.index')}}"><i class="material-icons">list</i> 情報編集</a>
        </div>
    </div>
</div>


@endsection
