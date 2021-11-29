@extends('template')

@section('content')


<div class="card">
    <div class="card-body">
        {{ Breadcrumbs::render('group.create',$type) }}
        @include($type->view["create"]["path"],['type'=>$type])
    </div>
</div>


@endsection
