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

@endsection



@can('update',$group)
<form id="set_here" action="{{route('group.location.set_here',$group)}}" method="POST">
    @csrf
    <input type="hidden" name="latitude">
    <input type="hidden" name="longitude">
    <button type="submit" class="btn btn-outline-success btn-round btn-sm mr-2"><i class="material-icons">my_location</i> 現在地を地点に設定</button>
</form>
<script type="module">
    $(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
        (position) => {
            $('input[name="latitude"]').val(position.coords.latitude); 
            $('input[name="longitude"]').val(position.coords.longitude); 
        });
    }
    })
</script>
@endcan