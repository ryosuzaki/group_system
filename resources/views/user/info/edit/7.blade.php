<form method="POST" action="{{ route('announcement.send',[$group]) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">タイトル</label>
        <input id="title" type="text" class="form-control form-control-lg" name="title" value="">
    </div> 


    <div class="form-group">
        <label for="content">内容</label>
        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
    </div>

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
        送信
        </button>
    </div>

</form>

