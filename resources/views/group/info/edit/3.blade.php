<form method="POST" action="{{ route('group.info.update',[$group->id,$index]) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="info">地点情報</label>
        <textarea class="form-control" id="info" name="info[detail]" rows="5">{{$info->info['detail']}}</textarea>
    </div>

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
        変更
        </button>
    </div>

</form>

