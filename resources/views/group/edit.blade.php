@extends('template')

@section('content')


<div class="card">
    {{ Breadcrumbs::render('group.edit',$group) }}
    <div class="card-body">
        <h3 class="text-center mb-4">変更</h3>
        
        <form method="POST" action="{{route('group.update',$group->id)}}">
            @csrf
            {{ method_field('PUT') }}

            @if(Illuminate\Support\Facades\View::exists('group.edit.'.$group->getTypeName()))
            @include('group.edit.'.$group->getTypeName(),['group'=>$group])
            @else
            <div class="form-group">
                <label for="name">グループ名</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$group->name}}" required autofocus>
            </div>
            @endif               
            <div class="form-group mb-0 mt-4">
                <button type="submit" class="btn btn-primary btn-block">
                変更
                </button>
            </div>
        </form>
    </div>
</div>

@can('delete',$group)
<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4 mt-5">グループの削除</h3>
        <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger btn-block text-white mt-5">削除</button>
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        本当にグループを削除しますか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                        <form action="{{route('group.destroy',$group->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger text-white">削除する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan



@endsection