@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('group.home',$type) }}
            <div class="card-body">
                <h3 class="text-center mb-4">{{$type->getName()}}</h3>
                @include($type->view["home"]["path"], ['type'=>$type])
            </div>
        </div>
    </div>
</div>
@endsection