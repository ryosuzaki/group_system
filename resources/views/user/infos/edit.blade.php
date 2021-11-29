@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.info_base.edit',$base) }}
    <div class="card-body">
        <h3 class="text-center mb-4">変更</h3>

        <form method="POST" action="{{route('user.info_base.update',[$base->id])}}">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group row">
                <label for="name">情報名</label>
                <input id="name" type="text" class="form-control" name="name" value="{{$base->name}}" required autofocus>
            </div>                       
            <div class="form-group row mb-0">
                <button type="submit" class="btn btn-primary btn-block">
                変更
                </button>
            </div>
        </form>
    </div>
</div>

@endsection