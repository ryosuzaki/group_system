<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <div>
    <h2>家族情報(代表者)</h2>
        <p class="h5 mt-4 mb-0">【氏名】</p>
        <input type="text" class="form-control" name="info[fami_name]" value="{{$base->info()->info['fami_name']}}">
        <p class="h5 mt-4 mb-0">【性別】</p>
        <div>
            <input type="hidden" id="sex" name="info[fami_sex]" value="{{$base->info()->info['fami_sex']}}">
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                <input type="radio" id="man" class="form-check-input" name="info[fami_sex]" value="男性">男性
                    <span class="circle">
                        <span class="check"></span>
            　      </span>
                </label>
            </div>
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" id="woman" class="form-check-input" name="info[fami_sex]" value="女性">女性
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" id="other" class="form-check-input" name="info[fami_sex]" value="その他">その他
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </div>
        <p class="h5 mt-4 mb-0">【年齢】</p>
        <div>
            <input type="number" class="form-control" name="info[fami_age]" value="{{$base->info()->info['fami_age']}}">
        </div>
        <p class="h5 mt-4 mb-0">【続柄】</p>
        <div>
            <input type="text" class="form-control" name="info[fami_posi]" value="{{$base->info()->info['fami_posi']}}">
        </div>
        <p class="h5 mt-4 mb-0">【住所】</p>
        <div>
            <div class="form-group">
                <label for="input">郵便番号</label>
                <input type="text" class="form-control" name="info[fami_post]" value="{{$base->info()->info['fami_post']}}">
            </div>
            <div class="form-group">
                <label for="input">番地まで</label>
                <input type="text" class="form-control" name="info[fami_addr1]" value="{{$base->info()->info['fami_addr2']}}">
            </div>
            <div class="form-group">
                <label for="input">建物名・部屋番号</label>
                <input type="text" class="form-control" name="info[fami_addr2]" value="{{$base->info()->info['fami_addr2']}}">
               </div>
        </div>
        <p class="h5 mt-4 mb-0">【電話番号】</p>
        <input type="tel" class="form-control" name="info[fami_tel]" value="{{$base->info()->info['fami_tel']}}"><br>
        <p class="h5 mt-4 mb-0">【メールアドレス】</p>
        <input type="email" class="form-control" name="info[fami_mail]" id="exampleFormControlInput1" placeholder="name@example.com" value="{{$base->info()->info['fami_mail']}}"><br>
    </div>
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</div>
</form>
<script>
    var sex = document.getElementById("sex");
    sex = sex.value;
    if(sex=="男性"){
        var check = document.getElementById("man");
        check.setAttribute("checked");
    }else if(sex=="女性"){
        var check = document.getElementById("woman");
        check.setAttribute("checked","");
    }else if(sex==""){
    }else{
        var check = document.getElementById("other");
        check.setAttribute("checked","");
    }
</script>
