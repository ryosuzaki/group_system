<form method="POST" action="{{ route('group.info.update',[$group->id,$index])) }}">
    @csrf
    @method('PUT')

    <div class="form-check form-check-radio form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="info[main]" value="元気"> 元気
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
    </div>

    <div class="form-check form-check-radio form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="info[main]" value="普通"> 普通
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
    </div>

    <div class="form-check form-check-radio form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="info[main]" value="不調"> 不調
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
    </div>

    <div class="form-group mb-0 mt-3">
        <button type="submit" class="btn btn-primary btn-block">
            回答
        </button>
    </div>

</form>
