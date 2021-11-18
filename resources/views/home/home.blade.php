@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('home') }}
            <div class="card-body">
                <h3 class="text-center mb-4">ホーム</h3>
                @foreach($types as $type)
                <h4><a href="{{route('home.group_type',$type)}}">{{$type->formatted_name}}</a></h4>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
