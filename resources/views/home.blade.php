@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('home') }}
            <div class="card-body">
                <h3 class="text-center mb-4">ホーム</h3>
                @foreach(App\Models\Group\GroupType::all() as $type)
                <a class="btn btn-primary btn-lg text-white btn-block" href="{{route('group.home',$type)}}">{{$type->getName()}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
