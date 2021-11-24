@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.info.edit',$base) }}
    <div class="card-body">
        <h3 class="text-center mb-4">{{$base->name}}の{{$base->edit['name']}}</h3>
        @php
        $template=$base->getTemplate();
        @endphp
        @include($template->view["edit"]["path"], ['info'=>$info,'user'=>$user,"base"=>$base,'index'=>$index,"template"=>$template])
    </div>
</div>

@endsection