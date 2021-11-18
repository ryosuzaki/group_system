<form method="POST" action="{{ route('user.questionnaire.update',[$base->id]) }}">
    @csrf
    @method('PUT')


    <div id="questionnaire_body">


            <ul class="nav nav-pills nav-pills-icons d-flex justify-content-between px-0" data-tabs="tabs">
                <li class="nav-item mx-auto w-25 @if(in_array('feeling', $info->info['not_use_items'])) d-none @endif">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#1" id="t1" data-toggle="tab">調子</a>
                </li>
                <li class="nav-item mx-auto w-25 @if(in_array('syokuyoku', $info->info['not_use_items'])) d-none @endif">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#2" id='t2' data-toggle="tab">食欲</a>
                </li>
                <li class="nav-item mx-auto w-25 @if(in_array('otuzi', $info->info['not_use_items'])) d-none @endif">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#3" id="t3" data-toggle="tab">お通じ</a>
                </li>
                <li class="nav-item mx-auto w-25 @if(in_array('taion', $info->info['not_use_items'])) d-none @endif">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#4" id="t4" data-toggle="tab">体温</a>
                </li>
                <li class="nav-item mx-auto w-25 @if(in_array('taiju', $info->info['not_use_items'])) d-none @endif">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#5" id="t5" data-toggle="tab">体重</a>
                </li>
                <li class="nav-item mx-auto w-25 @if(in_array('ketuatu', $info->info['not_use_items'])) d-none @endif">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#6" id="t6" data-toggle="tab">血圧</a>
                </li>
                <li class="nav-item mx-auto w-25 @if(in_array('warui_bui', $info->info['not_use_items'])) d-none @endif">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#7" id="t7" data-toggle="tab">症状</a>
                </li>
                <li class="nav-item mx-auto w-25 @if(in_array('comment', $info->info['not_use_items'])) d-none @endif">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#8" id="t8" data-toggle="tab">コメント</a>
                </li>
                <li class="nav-item mx-auto w-25">
                    <a class="nav-link h4 px-0 my-1" style="min-width:50px;" href="#9"  id="t9" data-toggle="tab">回答一覧</a>
                </li>
            </ul>
                        

                <div class="tab-content text-center mt-3">



                    <div class="tab-pane @if(in_array('feeling', $info->info['not_use_items'])) d-none @endif" id="1">
                        <span class="h2">調子</span>
                        <input type="hidden" name="info[feeling]" value="">
                        <div class="form-check">
                            <input type="radio" name="info[feeling]" id = "tyousi_yoi" value = "良い" class="form-check-input">
                            <label for = "tyousi_yoi"  class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/mark_face_laugh.png')}}"><p class="h3 text-dark">よい</p></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="info[feeling]" id = "tyousi_hutuu" value = "普通" class="form-check-input">
                            <label for = "tyousi_hutuu" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/mark_face_smile.png')}}"><p class="h3 text-dark">ふつう</p></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="info[feeling]" id = "tyousi_warui" value = "悪い" class="form-check-input">
                            <label for = "tyousi_warui" class="btn btn-outline-primary btn-block check"><img src="{{asset('img/health-questionnaire/mark_face_cry.png')}}"><p class="h3 text-dark">わるい</p></label>
                        </div>
                        
                        <button type="button" class="btn btn-primary btn-block change_next_pill_tab mt-4">次の質問へ</button>
                        
                        
                    </div>



                    <div class="tab-pane @if(in_array('syokuyoku', $info->info['not_use_items'])) d-none @endif" id="2"> <!質問２>
                        <span class=h2>食欲</span>
                        <input type="hidden" name="info[syokuyoku]" value="">
                        <div class="form-check">
                          <input type="radio" class="form-check-input" id="syokuyoku_yoi" name="info[syokuyoku]" value="良い">
                          <label class="btn btn-outline-primary  btn-block check" for="syokuyoku_yoi"><img src="{{asset('img/health-questionnaire/mark_face_laugh.png')}}"><p class="h3 text-dark">よい</p></label>
                        </div>
                        <div class="form-check"> <! 12493行目>
                          <input type = "radio" class="form-check-input" name="info[syokuyoku]" id = "syokuyoku_hutuu" value="普通">
                          <label  class="btn btn-outline-primary  btn-block check" for = "syokuyoku_hutuu"><img src="{{asset('img/health-questionnaire/mark_face_smile.png')}}"><p class="h3 text-dark">ふつう</p></label>
                        </div>
                        <div class="form-check">
                            <input type = "radio" class="form-check-input" name="info[syokuyoku]" id = "syokuyoku_warui" value="悪い">
                            <label for = "syokuyoku_warui" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/mark_face_cry.png')}}"><p class="h3 text-dark">わるい</p></label>
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">前の質問へ</button>
                            <button type="button" class="btn btn-primary change_next_pill_tab mt-4">次の質問へ</button>
                        </div>
                        

                    </div>


                    <div class="tab-pane @if(in_array('otuzi', $info->info['not_use_items'])) d-none @endif" id="3"><!質問３>
                        <span class=h2>お通じ</span>
                        <input type="hidden" name="info[otuzi]" value="">
                        <div class="form-check">
                          <input type = "radio" name = "info[otuzi]" id= "otuzi_katai" value = "固い" class="form-check-input">
                          <label for = "otuzi_katai" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/コロコロ(かたい).png')}}" width="200"><p class="h3 text-dark">かたい</p></label>
                        </div>
                        <div class="form-check">
                            <input type = "radio" name = "info[otuzi]" id="otuzi_hutuu" value = "普通" class="form-check-input">
                            <label for = "otuzi_hutuu" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/バナナ状(ふつう).png')}}" width="200"><p class="h3 text-dark">ふつう</p></label>
                        </div>
                        <div class="form-check">
                            <input type = "radio" name = "info[otuzi]" id = "otuzi_katati_nai" value = "形がない" class="form-check-input">
                            <label for = "otuzi_katati_nai" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/ビシャビシャ(形がない).png')}}" width="200"><p class="h3 text-dark">形がない</p></label>
                        </div>
                        <div class="form-check">
                            <input type = "radio" name = "info[otuzi]" id = "otuzi_denai" value = "出ない" class="form-check-input">
                            <label for = "otuzi_denai" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/でない.png')}}" width="200"><p class="h3 text-dark">でない</p></label>
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">前の質問へ</button>
                            <button type="button" class="btn btn-primary change_next_pill_tab mt-4">次の質問へ</button>
                        </div>
                        
                    </div>



                    <div class="tab-pane @if(in_array('taion', $info->info['not_use_items'])) d-none @endif" id="4"><!質問4>
                        <span class=h2>体温（℃）</span>
                        <select id = "taion" name = "info[taion]" class="btn btn-outline-secondary form-control" value="{{$base->info()->info['taion']}}">
                            <option value="">測っていない</option>
                            <option value="35.5℃より低い">35.5℃より低い</option>
                            <option value="35.5~36.0">35.5~36.0</option>
                            <option value="36.1~36.5">36.1~36.5</option>
                            <option value="36.6~37.0">36.6~37.0</option>
                            <option value="37.1~37.5">37.1~37.5</option>
                            <option value="37.6~38.0">37.6~38.0</option>
                            <option value="38.1~38.5">38.1~38.5</option>
                            <option value="38.6~39.0">38.6~39.0</option>
                            <option value="39.0℃より高い">39.0℃より高い</option>
                        </select>
                        
                        <div>
                            <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">前の質問へ</button>
                            <button type="button" class="btn btn-primary change_next_pill_tab mt-4">次の質問へ</button>
                        </div>
                        

                    </div>



                    <div class="tab-pane @if(in_array('taiju', $info->info['not_use_items'])) d-none @endif" id="5"><!質問5>
                        <span class=h2>体重（kg）</span>
                        <input type = "number" name = "info[taiju]" id="taiju" class="btn btn-outline-secondary form-control" value="{{$base->info()->info['taiju']}}">
                        
                        <div>
                            <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">前の質問へ</button>
                            <button type="button" class="btn btn-primary change_next_pill_tab mt-4">次の質問へ</button>
                        </div>
                        
                    </div>



                    <div class="tab-pane @if(in_array('ketuatu', $info->info['not_use_items'])) d-none @endif" id="6"><!質問6>
                        <span class=h2>血圧（mmHg）</span>
                        <input type = "number" name = "info[ketuatu_saikou]" id="ketuatu_saikou" class="btn btn-outline-secondary form-control" placeholder="最高" value="{{$base->info()->info['ketuatu_saikou']}}">
                        <input type = "number" name = "info[ketuatu_saitei]" id="ketuatu_saitei" class="btn btn-outline-secondary form-control" placeholder="最低" value="{{$base->info()->info['ketuatu_saitei']}}">
                        
                        <div>
                            <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">前の質問へ</button>
                            <button type="button" class="btn btn-primary change_next_pill_tab mt-4">次の質問へ</button>
                        </div>

                    </div>


                    <div class="tab-pane @if(in_array('warui_bui', $info->info['not_use_items'])) d-none @endif" id="7"><!質問7>
                        <span class=h2>症状</span>
                        <input type="hidden" name="info[warui_bui][]" value="">
                        <div class="form-check">
                            <input type = "checkbox" id = "zutuu" name = "info[warui_bui][]" value = "頭痛" class="form-check-input">
                            <label for="zutuu" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/症状/頭痛.png')}}" width="100%"  height="100%"></label>
                        </div>

                        <div class="form-check">
                            <input type = "checkbox" id="hanamizu" name = "info[warui_bui][]"  value = "鼻水"  class="form-check-input">
                            <label for="hanamizu" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/症状/鼻水・鼻づまり.png')}}"  width="100%" height="100%"></label>
                        </div>

                        <div class="form-check">
                            <input type = "checkbox" id="nodono_itami" name = "info[warui_bui][]" value = "のどの痛み" class="form-check-input">
                            <label for="nodono_itami" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/症状/のどの痛み.png')}}" width="100%"  height="100%"></label>
                        </div>

                        <div class="form-check">
                            <input type = "checkbox" id="darui" name = "warui_bui[]" value = "だるい" class="form-check-input">
                            <label for="darui" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/症状/だるい.png')}}" width="100%"  height="100%"></label>
                        </div>

                        <div class="form-check">
                            <input type = "checkbox" id="karada_itai" name = "info[warui_bui][]" value = "関節や体がいたい" class="form-check-input">
                            <label for="karada_itai" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/症状/関節やからだが痛い.png')}}"  width="100%"  height="100%"></label>
                        </div>

                        <div class="form-check">
                            <input type = "checkbox" id="onakaga_itai" name = "info[warui_bui][]" value = "お腹" class="form-check-input">
                            <label for="onakaga_itai" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/症状/お腹が痛い.png')}}"  width="100%"  height="100%"></label>
                        </div>

                        <div class="form-check">
                            <input type = "checkbox" id="geri" name = "info[warui_bui][]" value = "下痢" class="form-check-input">
                            <label for="geri" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/症状/下痢.png')}}" width="100%"  height="100%"></label>
                        </div>

                        <div class="form-check">
                            <input type = "checkbox" id="hakike_outo" name = "info[warui_bui][]" value = "吐き気" class="form-check-input">
                            <label for="hakike_outo" class="btn btn-outline-primary  btn-block check"><img src="{{asset('img/health-questionnaire/症状/吐き気・嘔吐.png')}}"  width="100%"  height="100%"></label>
                        </div>


                        <div>
                            <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">前の質問へ</button>
                            <button type="button" class="btn btn-primary change_next_pill_tab mt-4">次の質問へ</button>
                        </div>

                    </div>


                    <div class="tab-pane @if(in_array('comment', $info->info['not_use_items'])) d-none @endif" id="8">
                        <p class="h2">コメント</p>
                        <textarea class="form-control" id="comment" name="info[comment]" rows="5"></textarea>
                        
                        <div>
                            <button type="button" class="btn btn-primary change_prev_pill_tab mt-4">前の質問へ</button>
                            <button type="button" class="btn btn-primary change_next_pill_tab mt-4">次の質問へ</button>
                        </div>

                    </div>



                    <div class="tab-pane" id="9">
                        <p class="h2">回答一覧</p>
                        <table class="table">
                            <tr class="@if(in_array('feeling', $info->info['not_use_items'])) d-none @endif"><td>調子</td><td><div id="tyousi_out"></div></td></tr>
                            <tr class="@if(in_array('syokuyoku', $info->info['not_use_items'])) d-none @endif"><td>食欲</td><td><div id="syokuyoku_out"></div></td></tr>
                            <tr class="@if(in_array('otuzi', $info->info['not_use_items'])) d-none @endif"><td>お通じ </td><td><div id="otuzi_out"></div></td></tr>
                            <tr class="@if(in_array('taion', $info->info['not_use_items'])) d-none @endif"><td>体温 </td><td><div id="taion_out"></div></td></tr>
                            <tr class="@if(in_array('taiju', $info->info['not_use_items'])) d-none @endif"><td>体重 </td><td><div id="taiju_out"></div></td></tr>
                            <tr class="@if(in_array('ketuatu', $info->info['not_use_items'])) d-none @endif"><td>血圧 </td><td><div id="ketuatu_out"></div></td></tr>
                            <tr class="@if(in_array('warui_bui', $info->info['not_use_items'])) d-none @endif"><td>症状</td><td><div id="warui_bui_out"></div></td></tr>
                            <tr class="@if(in_array('comment', $info->info['not_use_items'])) d-none @endif"><td>コメント</td><td><div id="comment_out"></div></td></tr>
                            <tr><td width="30%"></td><td width="70%"></td></tr>
                        </table>

                        <script type="module">
                        $(function(){
                            for(var check = 1;check < 9;check++){
                                var activeid = $('#' + check);
                                var d_none = activeid.attr("class");
                                if(d_none.match(/d-none/)){
                                }else{
                                    var tabid = "t" + check;
                                    var activetab = $('#' + tabid);
                                    activeid.addClass("active");
                                    activetab.addClass("active");
                                    break;
                                }
                            };
                            $('#questionnaire_body img').css({"pointer-events":"none"});

                            $('#questionnaire_body input,#questionnaire_body select').change(function(){
                            var jstyousi = $('[name="info[feeling]"]:checked').val();//1
                            var idtyousi = document.getElementById("tyousi_out");
                            idtyousi.innerHTML = jstyousi;

                            var jssyokuyoku = $('[name="info[syokuyoku]"]:checked').val();//2
                            var idsyokuyoku = document.getElementById("syokuyoku_out");
                            idsyokuyoku.innerHTML = jssyokuyoku;

                            var jsotuzi = $('[name="info[otuzi]"]:checked').val();//3
                            var idotuzi = document.getElementById("otuzi_out");
                            idotuzi.innerHTML = jsotuzi;

                            var jstaion = $('#taion').val(); //4体温
                            var idtaion = document.getElementById("taion_out");
                            idtaion.innerHTML = jstaion;

                            var jstaiju = $('#taiju').val(); //5
                            var idtaiju = document.getElementById("taiju_out");
                            idtaiju.innerHTML = jstaiju;

                            var jsketuatu_saikou = $('#ketuatu_saikou').val(); //6
                            var jsketuatu_saitei = $('#ketuatu_saitei').val();
                            var idketuatu = document.getElementById("ketuatu_out");
                            idketuatu.innerHTML = '最高：' + jsketuatu_saikou + '<br>' + '最低：' +jsketuatu_saitei;


                            var jswarui_bui = $('[name="info[warui_bui][]"]:checked').map(function(){
                                return $(this).val();
                            })
                            var idwarui_bui = document.getElementById("warui_bui_out");
                            if('#warui_bui_out' != ''){
                                idwarui_bui.innerHTML = '';     //中を空にする
                            }
                            for(var i = 0; i<jswarui_bui.length; i++){
                                idwarui_bui.insertAdjacentHTML('beforeend', jswarui_bui[i] + '<br>');
                            }


                            var jscomment = $('#comment').val();
                            var idcomment = document.getElementById('comment_out');
                            idcomment.innerHTML = jscomment;
                            });
                        })
                        </script>

                    </div>
                
                    <script type="module">
                        $(function(){
                            $('.change_next_pill_tab').click(function(){
                                $(window).scrollTop($('#questionnaire_body').offset().top);
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
                                $(window).scrollTop($('#questionnaire_body').offset().top);
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
                                }                            });
                        })
                    </script>



                    <div class="form-group mb-0 mt-5">
                        <button type="submit" class="btn btn-primary btn-block">
                        回答して終了
                        </button>
                    </div>
                </div>
                        

    </div>
    

</form>
