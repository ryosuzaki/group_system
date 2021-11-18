@extends('template')

@section('content')


<form method="POST" action="{{route('group.role.update',[$group->id,$role->index])}}">
    @csrf
    {{ method_field('PUT') }}
    <div class="card">
    {{ Breadcrumbs::render('group.role.edit',$group,$role->index) }}
        <div class="card-body">
            <h3 class="text-center mb-4">変更</h3>


                <div class="form-group">
                    <label for="name">役割名</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$role->role_name}}" required>
                </div>
                <div class="form-group">
                    <label for="now_password">現在のパスワード</label>
                        <input id="now_password" type="password" class="form-control @error('now_password') is-invalid @enderror" name="now_password">
                        @error('now_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="password">新しいパスワード</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                </div>

                <div class="form-group">
                    <label for="password-confirm">新しいパスワードを再入力</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>   
            
                <div class="form-group mt-5 mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                        変更
                    </button>
                </div>
        </div>
    </div>
</form>


@endsection