@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('group.user.show',$group,$user,$index) }}
            <div class="card-body">
                <h3 class="text-center">{{$user->name}}</h3>
                <p class="h3 text-center">{{$user->email}}</p>
            </div>
        </div>
        <div class="card mt-0">
            <div class="card-body">
                <ul class="nav nav-pills nav-pills-primary">
                    @foreach ($infos as $info)
                    <li class="nav-item mx-auto">
                        <a class="nav-link @if($infos[0]==$info) active @endif" href="#pill{{$info->id}}" data-toggle="tab">{{$info->name}}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content tab-space pb-0">
                    @foreach ($infos as $info)
                    <div class="tab-pane @if($infos[0]==$info) active @endif" id="pill{{$info->id}}">
                        @include('user.info.show.'.$info->getTemplate()->id, ['info'=>$info])
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection