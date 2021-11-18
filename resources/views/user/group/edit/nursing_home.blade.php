@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$user}}
                    {{$group}}
                    <form method="POST" action="{{route('user.group.update',[$user->id,$group->id])}}">
                        @csrf
                        {{ method_field('PUT') }}

                        
                        <div class="form-group row">
                            <select class="form-control selectpicker" data-style="btn btn-link" name="role_id">
                                @foreach($group->roles()->get() as $role)
                                <option value="{{$role->id}}">{{$role->rank}} {{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="form-group row">
                            <label for="password">パスワード</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                            更新
                            </button>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection