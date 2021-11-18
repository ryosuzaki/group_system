@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.edit') }}
    <div class="card-body">
        <form method="POST" action="{{route('user.update',$user->id)}}">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group row">
                <label for="name">名前</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="email">メールアドレス</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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