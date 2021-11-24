<form method="POST" action="{{ route('group.info.update',[$group->id,$index]) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="body">情報</label>
        <textarea class="form-control" id="body" name="info[body]" rows="5"　required　autofocus>{{$info->info['body']}}</textarea>
    </div>  
    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
            変更
        </button>
    </div>
</form>