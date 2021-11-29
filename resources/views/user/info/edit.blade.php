@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.info.edit',$info) }}
    <div class="card-body">
        <h3 class="text-center mb-4">{{$info->name}}の{{$info->edit['name']}}</h3>
        @include($template->view["edit"]["path"], ['info'=>$info,'user'=>$user,'index'=>$index,"template"=>$template])
    </div>
</div>

@endsection