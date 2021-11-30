@extends('template')

@section('content')


<div class="card">
{{ Breadcrumbs::render('group.infos.create',$group) }}
    <div class="card-body">
        <h3 class="text-center mb-4">変更</h3>


        <form method="POST" action="{{route('group.infos.update',[$group->id,$info->index])}}">
            @csrf
            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="name">名前</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$info->name}}" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input type="hidden" name="viewable" value="0">
                    <input class="form-check-input" type="checkbox" name="viewable" value="1" @if($info->viewable) checked @endif>
                    一般に公開する
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>

            <div class="form-group mb-0 mt-4">
                <button type="submit" class="btn btn-primary btn-block">
                変更
                </button>
            </div>
        </form>
    </div>
</div>


@endsection