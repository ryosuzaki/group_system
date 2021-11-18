@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.info.edit',$base) }}
    <div class="card-body">
        <h3 class="text-center mb-4">{{$base->name}}の{{$base->getTemplate()->edit['name']}}</h3>


        
            @include('user.info.edit.'.$base->getTemplate()->id, ['info' => $info])
        
    </div>
</div>

@endsection