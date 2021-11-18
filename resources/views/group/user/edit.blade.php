@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('group.user.update',[$group->id,$user->id])}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <select class="form-control selectpicker" data-style="btn btn-link" name="role_id">
                            @foreach($group->roles()->get() as $role)
                                <option value="{{$role->id}}">{{$role->role_name}}</option>
                            @endforeach
                        </select>
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
@endsection