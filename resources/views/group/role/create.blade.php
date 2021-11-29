@extends('template')

@section('content')


<form method="POST" action="{{ route('group.role.store',$group->id) }}">
@csrf
    <div class="card">
    {{ Breadcrumbs::render('group.role.create',$group) }}
        <div class="card-body">
            
            <h3 class="text-center mb-4">追加</h3>

            
                <div class="form-group ">
                    <label for="name">役割名</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group ">
                    <label for="password">パスワード</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group ">
                    <label for="password-confirm">パスワードを再入力</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>   

                <div class="form-group  mt-5 mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                        役割追加
                    </button>
                </div>
        </div>
    </div>
</form>


@endsection
