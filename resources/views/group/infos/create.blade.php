@extends('template')

@section('content')


<div class="card">
{{ Breadcrumbs::render('group.infos.create',$group) }}
    <div class="card-body">
        <h3 class="text-center mb-4">追加</h3>


        <form method="POST" action="{{ route('group.infos.store',$group->id) }}">
            @csrf

            @foreach($templates as $template)
            <div class="media ml-4">
                <div class="media-body">
                    <div class="form-check mb-4">
                        <label class="form-check-label row text-dark h5">
                            <input class="form-check-input" type="checkbox" name="templates[]" value="{{$template->id}}">
                            {{$template->getName()}}
                            <span class="form-check-sign position-absolute" style="top:4px; left:0;">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <p class="text-secondary">{{$template->detail}}</p>
                </div>
            </div>
            @endforeach

            <div class="form-group mb-0 mt-4">
                <button type="submit" class="btn btn-primary btn-block">
                追加
                </button>
            </div>
        </form>
    </div>
</div>


@endsection