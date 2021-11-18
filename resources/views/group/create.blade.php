@extends('template')

@section('content')


<div class="card">
    <div class="card-body">
        {{ Breadcrumbs::render('group.create',$type) }}
        @if(Illuminate\Support\Facades\View::exists('group.create.'.$type->name))
        @include('group.create.'.$type->name,['type'=>$type])
        @else
        @endif     
    </div>
</div>


@endsection
