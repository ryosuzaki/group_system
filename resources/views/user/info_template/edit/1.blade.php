<form method="POST" action="{{ route('group.info_base.info.update',[$group->id,$info->id]) }}">
    @csrf
    @method('PUT') 
    <div class="form-group row">
        <label for="info">情報</label>
        <textarea class="form-control" id="info" name="info[info]" rows="5"　required　autofocus>{{$info->pivot->info['info']}}</textarea>
    </div>  
    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary btn-block">
            登録
        </button>
    </div>
</form>