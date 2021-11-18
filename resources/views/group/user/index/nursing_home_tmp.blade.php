<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div>           <!-- 検索用のhtml -->
    <input type="text" class="" id="search1"> <input type="button" class="btn btn-primary" value="絞り込む" id="button"> <input type="button" class="btn btn-primary" value="すべて表示" id="button2">
    <br>
        <div class="card">
            <ul>
                <li class="card-text">健康アンケート<br>
                    <label><input type="checkbox" id="check3" checked="checked">回答あり</label>
                    <label><input type="checkbox" id="check4" checked="checked">回答なし</label>
                </li>

                <li class="card-text">避難／救助状況アンケート<br>
                    <label><input type="checkbox" id="check5" checked="checked">回答あり</label>
                    <label><input type="checkbox" id="check6" checked="checked">回答なし</label>
                </li>

                <li class="card-text">健康状態<br>
                    <label><input type="checkbox" id="check7" checked="checked">良い</label>
                    <label><input type="checkbox" id="check8" checked="checked">普通</label>
                    <label><input type="checkbox" id="check9" checked="checked">悪い</label>
                </li>

                <li class="card-text">避難状況<br>
                    <label><input type="checkbox" id="check10" checked="checked">避難済み</label>
                    <label><input type="checkbox" id="check11" checked="checked">避難中</label>
                    <label><input type="checkbox" id="check12" checked="checked">要救助</label>
                </li>

                <li class="card-text">救助状況<br>
                    <label><input type="checkbox" id="check13" checked="checked">向かっていない</label>
                    <label><input type="checkbox" id="check14" checked="checked">救助中</label>
                    <label><input type="checkbox" id="check15" checked="checked">救助済み</label>
                </li>
            </ul>
        </div>

                
    <table class="card">
        <tr class="card-text">
            <td><label><input type="checkbox" id="time1_check" onclick="checkbox_cell(this,'time1')" checked="checked">健康状態：回答時間</label></td>
            <td><label><input type="checkbox" id="time2_check" onclick="checkbox_cell(this,'time2')" checked="checked">避難状況：回答時間</label></td>
        </tr>
    </table>
</div>

<div class="table-responsive">
    <table class="table text-nowrap tablesorter" id="sorter">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <!--<th>メールアドレス</th>-->
            <th id="time1">健康状態 回答日時</th>
            <th>健康状態</th>
            <th id="time2">避難状況 回答日時</th>
            <th>避難状況</th>
            <th>救助状況</th>
            <th>アクション</th>
        </tr>
        </thead>
        <tbody>
            
            @foreach ($users as $user)
            <tr>
                <td><a href="{{route('group.user.show',[$group->id,$user->id,$role->index])}}">{{$user->name}}</a></td>
                <!--<td>{{$user->email}}</td>-->


                @php
                $exist=$user->getInfoBaseByTemplate(5)->isNotEmpty();
                if ($exist){
                    $info=$user->getInfoBaseByTemplate(5)->first()->info();
                }
                @endphp
                @if($exist)
                <td id="time1_check">{{($info->updated_at)}}</td>
                <td>{{$info->info['feeling']}}</td>
                @else
                <td></td><td></td>
                @endif


                @php
                $exist=$user->getInfoBaseByTemplate(6)->isNotEmpty();
                if ($exist){
                    $info=$user->getInfoBaseByTemplate(6)->first()->info();
                    $rescue=$info->info['rescue'];
                    $rescue_group=$info->info['group'];
                }
                @endphp
                @if($exist)
                <td id="time2_check">{{$info->info['last_answer']}}</td>
                <td>{{$info->info['evacuation']}}</td>
                <td>
                @if($rescue==config('kaigohack.rescue.rescue'))
                    @if($rescue_group==$group)
                    <a class="btn btn-danger btn-sm text-white m-0" href="{{route('group.user.unrescue',[$info->info['group']->id,$user->id])}}"><i class="material-icons">close</i> やめる</a>
                    <button type="button" data-toggle="modal" data-target="#rescued{{$user->id}}" class="btn btn-success btn-sm text-white m-0"><i class="material-icons">done</i> 完了</button>
                    <div class="modal fade" id="rescued{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="rescuedLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    本当に救助を完了しますか？
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                    <a class="btn btn-success text-white" href="{{route('group.user.rescued',[$info->info['group']->id,$user->id])}}">救助を完了</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{route('group.show',$rescue_group->id)}}">{{$rescue_group->name}}</a>が救助中
                    @endif
                @elseif($rescue==config('kaigohack.rescue.unrescue'))
                <a class="btn btn-warning btn-sm text-white m-0" href="{{route('group.user.rescue',[$group->id,$user->id])}}">救助に向かう</a>
                @elseif($rescue==config('kaigohack.rescue.rescued'))
                <a href="{{route('group.show',$rescue_group->id)}}">{{$rescue_group->name}}</a>が救助済み
                @endif
                </td>
                @else
                <td></td>
                <td></td>
                @endif

                <td class="row pt-1">
                @if($role->index!=0)
                
                    <button type="button" data-toggle="modal" data-target="#delete{{$user->id}}" class="btn btn-danger btn-round btn-sm text-white m-0"><i class="material-icons">logout</i> 退出</button>
                    <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    本当にユーザーを退出させますか？
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                    <form action="{{route('group.user.destroy',[$group->id,$user->id,$role->index])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger text-white">退出させる</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script type="module">
    $(document).ready(function() { 
        $("#sorter").tablesorter();
    });
</script>
<script>
	$(function(){
	  
		  //利用者の名前検索
	var txt_array = [ "check3" , "check4" , "check5" , "check6" , "check7" , "check8" , "check9" , "check11" , "check12" , "check13" , "check14" , "check15"];
	var re_array = [  "回答なし" , "要救助" , "避難済み"  , "避難中" , "救助に向かう" , "救助済み" , "良い" , "普通" , "悪い"];
	var check_array = ["a"];
	var shows;
	var j = 0;
	var i = 0;
	var l = 0;
	  
			//検索内容を取って判別する関数
	$('#button').bind("click",function(){
		var re = new RegExp($('#search1').val());   //テキストに入れた文字を取得
	  
					  //ここから次のfunctionまでは一つの質問でチェックの有無が違う場合にcheck_arrayにその添字を格納しているもの
					  //排他的論理和で１になるものを調べている
	  
            var check1 = document.getElementById( txt_array[0] );
			var check2 = document.getElementById( txt_array[1] );
			if( check1.checked == true && check2.checked == false ){
				check_array[j] = 0;
				j++;
			}else if( check1.checked == false && check2.checked == true ){
				check_array[j] = 1;
				j++;
			}
			var check1 = document.getElementById( txt_array[2] );
			var check2 = document.getElementById( txt_array[3] );
			if( check1.checked == true && check2.checked == false ){
				check_array[j] = 2;
				j++;
			}else if( check1.checked == false && check2.checked == true ){
				check_array[j] = 3;
				j++;
			}
            i = 4
            for(;i < txt_array.length;){
                check1 = document.getElementById( txt_array[i] );
                i++
                check2 = document.getElementById( txt_array[i] );
                i++
                var check3 = document.getElementById( txt_array[i] );
                if( check2.checked == check3.checked && check1.checked != check2.checked ){
                    check_array[j] = i - 2;
                    j++;
                }else if( check1.checked == check3.checked && check2.checked != check1.checked ){
                    check_array[j] = i - 1;
                    j++;
                }else if( check1.checked == check2.checked && check3.checked != check1.checked ){
                    check_array[j] = i;
                    j++;
                }
                i++
            }
	  
			i = 0;
			j = 0;
			$('#sorter tbody tr').each(function(){
				var txt = $(this).find("td:eq(0)").html();      //th:eq()で検索したい表の検索する列を指定している。()の中の数字で検索する列が変わる。
				if(txt.match(re) != null){
					shows = this;
				}
				i = 0;
				if( check_array[i] == 0){
					i++;
					var txt1 = $(this).find("td:eq(2)").html();
					if( txt1.match(re_array[0]) == null ){
					}else{
						shows = "";
					}
				}
                if( check_array[i] == 1){
					i++;
					var txt1 = $(this).find("td:eq(2)").html();
					if( txt1.match(re_array[0]) != null ){
					}else{
						shows = "";
					}
				}

				if( check_array[i] == 2){
					i++;
					var txt1 = $(this).find("td:eq(4)").html();
					if( txt1.match(re_array[0]) == null ){
					}else{
						shows = "";
					}
				}
                if( check_array[i] == 3){
					i++;
					var txt1 = $(this).find("td:eq(4)").html();
					if( txt1.match(re_array[0]) != null ){
					}else{
						shows = "";
					}
				}
				if( check_array[i] == 4){
					i++;
					var txt1 = $(this).find("td:eq(2)").html();
					var check = document.getElementById( txt_array[2] );
					if( check.checked == true ){
						if( txt1.match(re_array[6]) != null ){
						}else{
							shows = "";
						}
					}else{
						if( txt1.match(re_array[6]) != null ){
							shows = "";
						}
					}
				}
				if( check_array[i] == 5){
					i++;
					var txt1 = $(this).find("td:eq(2)").html();
					var check = document.getElementById( txt_array[3] );
					if( check.checked == true ){
						if( txt1.match(re_array[7]) != null ){
						}else{
							shows = "";
						}
					}else{
						if( txt1.match(re_array[7]) != null ){
							shows = "";
						}
					}
				}
				if( check_array[i] == 6){
					i++;
					var txt1 = $(this).find("td:eq(2)").html();
					var check = document.getElementById( txt_array[4] );
					if( check.checked == true ){
						if( txt1.match(re_array[8]) == null ){
						}else{
						    shows = "";
						}
					}else{
						if( txt1.match(re_array[8]) == null ){
						    shows = "";
						}
					}
				}
                if( check_array[i] == 7){
					i++;
					var txt1 = $(this).find("td:eq(4)").html();
					var check = document.getElementById( txt_array[2] );
					if( check.checked == true ){
						if( txt1.match(re_array[2]) != null ){
						}else{
							shows = "";
						}
					}else{
						if( txt1.match(re_array[2]) != null ){
							shows = "";
						}
					}
				}
				if( check_array[i] == 8){
					i++;
					var txt1 = $(this).find("td:eq(4)").html();
					var check = document.getElementById( txt_array[3] );
					if( check.checked == true ){
						if( txt1.match(re_array[3]) != null ){
						}else{
							shows = "";
						}
					}else{
						if( txt1.match(re_array[3]) != null ){
							shows = "";
						}
					}
				}
				if( check_array[i] == 9){
					i++;
					var txt1 = $(this).find("td:eq(4)").html();
					var check = document.getElementById( txt_array[4] );
					if( check.checked == true ){
						if( txt1.match(re_array[1]) != null ){
						}else{
						    shows = "";
						}
					}else{
						if( txt1.match(re_array[1]) != null ){
						    shows = "";
						}
					}
				}

				if( check_array[i] == 10){
					i++;
					var txt1 = $(this).find("td:eq(5)").html();
					var check = document.getElementById( txt_array[5] );
					if( check.checked == true ){
						if( txt1.match(re_array[4]) != null ){
						}else{
							shows = "";
						}
					}else{
						if( txt1.match(re_array[4]) != null ){
							shows = "";
						}
					}
				}
				if( check_array[i] == 11){
					i++;
					var txt1 = $(this).find("td:eq(5)").html();
					var check = document.getElementById( txt_array[6] );
					if( check.checked == true ){
						if( txt1.match(re_array[4]) != null ){
                            shows = "";
                        }
                        if( txt1.match(re_array[5]) != null){
                            shows = "";
                        }
					}else{
						if( txt1.match(re_array[4]) == null ){
                            if(txt1.match(re_array[5]) == null){
    						    shows = "";
                            }
						}
					}
				}
				if( check_array[i] == 12){
					i++;
					var txt1 = $(this).find("td:eq(5)").html();
					var check = document.getElementById( txt_array[7] );
					if( check.checked == true ){
						if( txt1.match(re_array[5]) != null ){
                        }else{
                            shows = "";
                        }
					}else{
						if( txt1.match(re_array[5]) != null ){
						    shows = "";
						}
					}
				}
	  
				if( shows == this ){
					$(this).show();
				}else{
					$(this).hide();
				}
			});
			check_array = ["a"];
		});
	  
	  
		  //全て表示のボタン↓
		$('#button2').bind("click",function(){
			$('#search1').val('');
			$('#sorter tr').show();
			var s = 0;
			while( s < txt_array.length ){
				var check = document.getElementById(txt_array[s]);
				check.checked = "checked";
				s++;
			}
		});
	});
		//表示する項目を絞る関数
	function checkbox_cell( obj,id ){
		var CELL = document.getElementById(id);
		var TABLE = CELL.parentNode.parentNode.parentNode;
		for(var i=0;TABLE.rows[i];i++) {
			TABLE.rows[i].cells[CELL.cellIndex].style.display = (obj.checked) ? '' : 'none';
		}
	}
</script>
