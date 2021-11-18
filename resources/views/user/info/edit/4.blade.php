<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
<div id="private">
    <div class="card-header card-header-primary mx-0 my-4">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">

                    <li class="nav-item mx-auto">
                        <a class="nav-link h4 active" href="#1" id="t1" data-toggle="tab">個人情報</a>
                    </li>
                    <li class="nav-item mx-auto">
                    	<a class="nav-link h4" href="#2" id='t2' data-toggle="tab">緊急連絡先</a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link h4" href="#3" id="t3" data-toggle="tab">その他</a>
                    </li>

				</ul>
            </div>
        </div>
    </div>
                        

	<div class="tab-content text-center">

        <div class="tab-pane active" id="1">
            <h2>個人情報</h2>
            <div class="text-left">
                <p class="h5 mt-4 mb-0">【性別】</p>
                <input type="hidden" id="sex" name="info[you_sex]" value="{{$base->info()->info['you_sex']}}">
                <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input class="form-check-input btn-check" type="radio" name="info[you_sex]" value="男性" @if($base->info()->info['you_sex']==="男性") checked @endif>男性
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
                </div>

                <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="info[you_sex]" value="女性" @if($base->info()->info['you_sex']==="女性") checked @endif>女性
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
                </div>

                <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="info[you_sex]" value="その他" @if($base->info()->info['you_sex']==="その他") checked @endif>その他
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
                </div>
            </div>
            <div>
                <p class="h5 mt-4 mb-0">【生年月日】</p>
                <div>
                    <div class="form-group">
                        <select placeholder="year" id="youyear" class="form-control youyear" name="info[you_year]" value="{{$base->info()->info['you_year']}}">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <select placeholder="month" class="form-control youmonth" name="info[you_month]" value="{{$base->info()->info['you_month']}}" onchange="inputDay(this)">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <select placeholder="day" class="form-control youday" name="info[you_day]" value="{{$base->info()->info['you_day']}}">
                            
                        </select>
                    </div>
                </div>
                <p class="h5 mt-4 mb-0">【住所】</p>
                <div class="form-group">
                    <label for="input">郵便番号</label>
                    <input type="text" class="form-control" name="info[you_post]" value="{{$base->info()->info['you_post']}}">
                </div>
                <div class="form-group">
                    <label for="input">番地まで</label>
                    <input type="text" class="form-control" name="info[you_addr1]" value="{{$base->info()->info['you_addr1']}}">
                </div>
                <div class="form-group">
                    <label for="input">建物名・部屋番号</label>
                    <input type="text" class="form-control" name="info[you_addr2]" value="{{$base->info()->info['you_addr2']}}">
                </div>
                <p class="h5 mt-4 mb-0">【電話番号】</p>
                <div>

                    <input type="tel" class="form-control" name="info[you_tel]" value="{{$base->info()->info['you_tel']}}">

                </div>
            </div>
            
            <div>
                <button type="button" class="btn btn-primary change_next_pill_tab mt-4">緊急連絡先へ</button>
            </div>

            <div class="form-group mb-0 mt-3">
                <button type="submit" class="btn btn-primary btn-block">
                    登録
                </button>
            </div>

        </div>
        <div class="tab-pane" id="2">
            <h2>家族情報(代表者)</h2>
            <p class="h5 mt-4 mb-0">【氏名】</p>
            <input type="text" class="form-control" name="info[fami_name]" value="{{$base->info()->info['fami_name']}}">
            <div>
                <p class="h5 mt-4 mb-0">【生年月日】</p>
                <div>
                    <div class="form-group">
                        <select placeholder="year" id="famiyear" class="form-control famiyear" name="info[fami_year]" value="{{$base->info()->info['fami_year']}}">
            
                        </select>
                    </div>
                    <div class="form-group">
                        <select placeholder="month" class="form-control famimonth" name="info[fami_month]" value="{{$base->info()->info['fami_month']}}" onchange="inputDay(this)">
                            <div class="month">

                            </div>
                        </select>
                    </div>
                    <div class="form-group">
                        <select placeholder="day" class="form-control famiday" name="info[fami_day]" value="{{$base->info()->info['fami_day']}}">
                            
                        </select>
                    </div>
                </div>
            </div>
            <p class="h5 mt-4 mb-0">【続柄】</p>
            <input type="text" class="form-control" name="info[fami_posi]" value="{{$base->info()->info['fami_posi']}}">

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
            
            <div>
                <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">個人情報へ</button>
                <button type="button" class="btn btn-primary change_next_pill_tab mt-4">その他へ</button>
            </div>
            
            <div class="form-group mb-0 mt-3">
                <button type="submit" class="btn btn-primary btn-block">
                    登録
                </button>
            </div>
        </div>


        <div class="tab-pane" id="3">
            <h2>その他</h2>

            <p class="h5 mt-4 mb-0">【最寄りの避難場所】</p>
            <input type="text" class="form-control" name="info[shelter]" value="{{$base->info()->info['shelter']}}">

            <div><p class="h5 mt-4 mb-0">【平熱】℃</p>
                <input type="number" class="form-control" step="0.1" name="info[temp]" value="{{$base->info()->info['temp']}}" placeholder="℃">
            </div>
            <div><p class="h5 mt-4 mb-0">【身長】cm</p>
                <input type="number" class="form-control" name="info[height]" value="{{$base->info()->info['height']}}" placeholder="cm">
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
            <p class="h5 mt-4 mb-0">【福祉用具（杖や車いすなど）使用の有無】</p>
            <input type="text" class="form-control" name="info[tools]" value="{{$base->info()->info['tools']}}"><br>

            <!--  ここからは介護事業者も入力可能の情報  -->
            <div><p class="h5 mt-4 mb-0">【同居人の有無】</p>
            <input type="hidden" id="house" name="info[housemate]" value="{{$base->info()->info['housemate']}}">
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" id="house_yes" class="form-check-input" name="info[housemate]" value="有り" @if($base->info()->info['housemate']==="有り") checked @endif>有り
                    <span class="circle">
                        <span class="check"></span>
            　      </span>
                </label>
            </div>
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" id="house_no" class="form-check-input" name="info[housemate]" value="無し" @if($base->info()->info['housemate']==="無し") checked @endif>無し
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>

            <div><p class="h5 mt-4 mb-0">【障害の有無】</p>
            <input type="hidden" id="hindrance" name="info[hindrance]" value="{{$base->info()->info['hindrance']}}">
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" id="hindrance_yes" class="form-check-input" name="info[hindrance]" value="有り" @if($base->info()->info['hindrance']==="有り") checked @endif>有り
                    <span class="circle">
                        <span class="check"></span>
            　      </span>
                </label>
            </div>
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" id="hindrance_no" class="form-check-input" name="info[hindrance]" value="無し" @if($base->info()->info['hindrance']==="無し") checked @endif>無し
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
            <p class="h5 mt-4 mb-0">【持っている障害】</p>
            <input type="text" class="form-control" name="info[hindrance_contents]" value="{{$base->info()->info['hindrance_contents']}}">

            <div><p class="h5 mt-4 mb-0">【電源の用途】</p>
            <input type="hidden" id="hindrance" name="info[volt]" value="{{$base->info()->info['volt']}}">
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" id="hindrance_yes" class="form-check-input" name="info[volt]" value="必要" @if($base->info()->info['volt']==="必要") checked @endif>必要
                    <span class="circle">
                        <span class="check"></span>
            　      </span>
                </label>
            </div>
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" id="hindrance_no" class="form-check-input" name="info[volt]" value="不要" @if($base->info()->info['volt']==="不要") checked @endif>不要
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
            <p class="h5 mt-4 mb-0">【電源の要不要】</p>
            <input type="text" class="form-control" name="info[volt_contents]" value="{{$base->info()->info['volt_contents']}}">


            <p class="h5 mt-4 mb-0">【介護サービスの有無】</p>
            <div>
                <input type="hidden" id="serv" name="info[service]" value="{{$base->info()->info['service']}}">
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input type="radio" id="serv_on" class="form-check-input" name="info[service]" value="有り" @if($base->info()->info['service']==="有り") checked @endif>有り
                        <span class="circle">
                            <span class="check"></span>
                    　  </span>
                    </label>
                </div>
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input type="radio" id="serv_off" class="form-check-input" name="info[service]" value="無し" @if($base->info()->info['service']==="無し") checked @endif>無し
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>

            <p class="h5 mt-4 mb-0">【サービス内容】</p>
            <input type="text" class="form-control" name="info[use_service]" value="{{$base->info()->info['use_service']}}">

            <p class="h5 mt-4 mb-0">【特記事項欄(自由コメント欄)】</p>
            <input type="text" class="form-control" name="info[comment]" value="{{$base->info()->info['comment']}}">
            
            <div>
                <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">緊急連絡先へ</button>
            </div>


            <div class="form-group mb-0 mt-3">
                <button type="submit" class="btn btn-primary btn-block">
                    登録
                </button>
            </div>
        </div>
        <script type="module">
            $(function(){
                $('.change_next_pill_tab').click(function(){
                    $(window).scrollTop($('#private').offset().top);
                    var now = $(this).closest('.tab-pane').attr('id');
                    var next = Number(now) + 1;
                    for(;next < 10;next++){
                        var nextclass = $('#' + next).attr("class");
                        if(nextclass.match(/d-none/)){
                        }else{
                            var nexttab = "t" + next;
                            var nowtab = "t" + now;
                            $('#' + now).removeClass("active");
                            $('#' + nowtab).removeClass("active");
                            $('#' + next).addClass("active");
                            $('#' + nexttab).addClass("active");
                            break;
                        }
                    }
                });
                $('.change_prev_pill_tab').click(function(){
                    $(window).scrollTop($('#private').offset().top);
                    var now = $(this).closest('.tab-pane').attr('id');
                    var prev = Number(now) - 1;
                    for(;prev > 0;prev--){
                         var prevclass = $('#' + prev).attr("class");
                        if(prevclass.match(/d-none/)){
                        }else{
                            var prevtab = "t" + prev;
                            var nowtab = "t" + now;
                            $('#' + now).removeClass("active");
                            $('#' + nowtab).removeClass("active");
                            $('#' + prev).addClass("active");
                            $('#' + prevtab).addClass("active");
                            break;
                        }
                    }
                });
            })
        </script>
        <script>
            var year = "";
            var month ="";
            var day = "";
            var endOfMonth=[31,30,29,28];
            window.onload  = function(){
                var now = new Date();
                var nowyear = now.getFullYear();
                for(var write = nowyear - 150;write <= nowyear;write++){
                    year += "<option value='" + write + "'>" + write + "</option>";
                }

                for(var write = 1;write < 13;write++){
                    month += "<option value='" + write + "'>" + write + "</option>";
                }

                for(var write = 1;write <= endOfMonth[0];write++){
                    day += "<option value='" + write + "'>" + write + "</option>";
                }
                    
                document.querySelector('.youyear').innerHTML = year;
                document.querySelector('.youmonth').innerHTML = month;
                document.querySelector('.youday').innerHTML = day;
                document.querySelector('.famiyear').innerHTML = year;
                document.querySelector('.famimonth').innerHTML = month;
                document.querySelector('.famiday').innerHTML = day;
            };
            function inputDay(month){
                console.log(month.value);
                day = "";
                var selectMonth = month.value;
                var thisclass = month.className;
                //31
                if(selectMonth == 1 ||selectMonth == 3 ||selectMonth == 5 ||selectMonth == 7 ||selectMonth == 8 ||selectMonth == 10 ||selectMonth == 12){
                    for(var write = 1;write <= endOfMonth[0];write++){
                        day += "<option value='" + write + "'>" + write + "</option>";
                    }
                }
                //30
                if(selectMonth == 4 ||selectMonth == 6 ||selectMonth == 9 ||selectMonth == 11){
                    for(var write = 1;write <= endOfMonth[1];write++){
                        day += "<option value='" + write + "'>" + write + "</option>";
                    }

                }
                 //28or29
                if(selectMonth == 2){
                    if(thisclass.match(/youmonth/)){
                        var thisyear = document.getElementById("youyear").value;
                    }else{
                        var thisyear = document.getElementById("famiyear").value;
                    }
                    if(thisyear % 4 == 0){
                        //29
                        for(var write = 1;write <= endOfMonth[2];write++){
                            day += "<option value='" + write + "'>" + write + "</option>";
                        }
                    }else{
                        //28
                        for(var write = 1;write <= endOfMonth[3];write++){
                            day += "<option value='" + write + "'>" + write + "</option>";
                        }
                    }
                }
                if(thisclass.match(/youmonth/)){
                    document.querySelector('.youday').innerHTML = day;
                    console.log("aaaa");
                }else{
                    document.querySelector('.famiday').innerHTML = day;
                }
            }

            </script>

    </div>
</div>
     


</form>
