<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <h2>医療</h2>
        <div><p class="h5 mt-4 mb-0">【平熱】℃</p>
            <input type="number" class="form-control" name="info[temp]" value="{{$base->info()->info['temp']}}" placeholder="℃">
        </div>
        <div><p class="h5 mt-4 mb-0">【身長】cm</p>
            <input type="number" class="form-control" name="info[height]" value="{{$base->info()->info['height']}}" placeholder="cm">
        </div>
        <div><p class="h5 mt-4 mb-0">【体重】kg</p>
             <input type="number" class="form-control" name="info[weight]" value="{{$base->info()->info['weight']}}" placeholder="kg">
         </div>
         <p class="h5 mt-4 mb-0">【使用中の薬】</p>
        <input type="text" class="form-control" name="info[medicine]" value="{{$base->info()->info['medicine']}}">
        <p class="h5 mt-4 mb-0">【アレルギー歴】</p>
        <input type="text" class="form-control" name="info[allergy]" value="{{$base->info()->info['allergy']}}">
        <p class="h5 mt-4 mb-0">【既往歴】</p>
        <input type="text" class="form-control" name="info[medical]" value="{{$base->info()->info['medical']}}">
        <p class="h5 mt-4 mb-0">【手術歴】</p>
        <input type="text" class="form-control" name="info[surgery]" value="{{$base->info()->info['surgery']}}">
        <p class="h5 mt-4 mb-0">【かかりつけ医】</p>
        <input type="text" class="form-control" name="info[hospital]" value="{{$base->info()->info['hospital']}}"><br>
        
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</form>
