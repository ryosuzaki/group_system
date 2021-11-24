@extends('template')

@section('content')


<div class="card">
{{ Breadcrumbs::render('group.info.edit',$group,$base->index) }}
    <div class="card-body">
        @php
        $template=$base->getTemplate();
        @endphp
        <h3 class="text-center mb-4">{{$base->name}}の{{$base->edit['name']}}</h3>
        @include($template->view["edit"]["path"], ['info'=>$info,'group'=>$group,"base"=>$base,'index'=>$index,"template"=>$template])

    </div>
</div>


@endsection