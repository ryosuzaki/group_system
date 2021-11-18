@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.announcement.show',$announcement) }}
    <div class="card-body">

        <p class="card-text h5">送信元：<a href="{{route('group.show',$announcement->data['model']['id'])}}">{{$announcement->data['model']['name']}}</a></p>
        <div class="text-center mb-3">
            <h4 class="h3 font-weight-bold">{{$announcement->data['announcement']['title']}}</h4>
            <p class="card-text h5" style="white-space:pre-line;">{{$announcement->data['announcement']['content']}}</p>
        </div>
        

    </div>
</div>

@endsection