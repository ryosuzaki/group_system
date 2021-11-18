<div>           
    <div class="form-group">
        <label>検索</label>
        <input class="form-control" type="text" id="search_in_table{{$base->index}}">
    </div> 
    <input type="button" class="btn btn-primary btn-block" value="すべて表示" id="button4">
    <br>
        <div class="card m-0" id="select_row_value{{$base->index}}">
            <ul class="list-unstyled">
                <li class="card-text list-unstyled">健康状態アンケート<br>
                    <label><input type="checkbox" id="check11" checked="checked">回答あり</label>
                    <label><input type="checkbox" id="check12" checked="checked">回答なし</label>
                </li>
                
                <li class="card-text list-unstyled">健康状態<br>
                    <label><input type="checkbox" id="check13" checked="checked">良い</label>
                    <label><input type="checkbox" id="check14" checked="checked">普通</label>
                    <label><input type="checkbox" id="check15" checked="checked">悪い</label>
                </li>

                <li class="card-text list-unstyled">体温<br>
                    <label><input type="checkbox" id="check16" checked="checked">通常</label>
                    <label><input type="checkbox" id="check17" checked="checked">微熱（37℃以上）</label>
                    <label><input type="checkbox" id="check18" checked="checked">高熱（38℃以上）</label>
                </li>
                <li class="card-text list-unstyled">症状<br>
                    <label><input type="checkbox" id="check19" checked="checked">頭痛</label>
                    <label><input type="checkbox" id="check20" checked="checked">鼻水</label>
                    <label><input type="checkbox" id="check21" checked="checked">のどの痛み</label>
                    <label><input type="checkbox" id="check22" checked="checked">関節や体が痛い</label>
                    <label><input type="checkbox" id="check23" checked="checked">お腹</label>
                    <label><input type="checkbox" id="check24" checked="checked">下痢</label>
                    <label><input type="checkbox" id="check25" checked="checked">吐き気</label>
                </li>
            </ul>
        </div>

                
    <table class="card">
        <tr class="card-text">
            <td><label><input type="checkbox" id="time_check2" onclick="checkbox_cell(this,'time2')" checked="checked">回答日時</label></td>
            <td><label><input type="checkbox" id="comment_check2" onclick="checkbox_cell(this,'comment2')" checked="checked">コメント</label></td>
            <td><label><input type="checkbox" id="bad_check" onclick="checkbox_cell(this,'bad')" checked="checked">症状</label></td>            
            <td><label><input type="checkbox" id="weight_check" onclick="checkbox_cell(this,'weight')" checked="checked">体重</label></td>            
        </tr>
    </table>
</div>

<div class="table-responsive">
    <table class="table text-nowrap tablesorter result2" id="sorter{{$base->index}}">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <th id="time2">回答日時</th>
            <th>健康状態</th>
            <th id="comment2">コメント</th>
            <th>体温</th>
            <th id="bad">症状</th>
            <th>食欲</th>
            <th>お通じ</th>
            <th id="weight">体重</th>
            <th>最高血圧</th>
            <th>最低血圧</th>
        </tr>
        </thead>
        <tbody>
            @php
            $users=$group->users()->get();
            @endphp

            @foreach ($users as $user)

            @php
            $info_base=$user->getInfoBaseByTemplate(5);
            @endphp

            @if(!empty($info_base))

            @php
            $info=$info_base->info();
            @endphp

            <tr>
                <td>{{$user->name}}</td>

                <td id="time_check2">{{($info->updated_at)}}</td>
                <td>{{$info->info['feeling']}}</td>
                <td id="comment_check2">{{$info->info["comment"]}}</td>
                <td><input type="hidden" value="{{$info->info['taion']}}">{{$info->info["taion"]}} ℃</td>
                <td id="bad_check">
                    @foreach($info->info["warui_bui"] as $bui)
                    {{$bui}}
                    @endforeach
                </td>
                <td>{{$info->info["syokuyoku"]}}</td>
                <td>{{$info->info["otuzi"]}}</td>
                <td id="weight_check">{{$info->info["taiju"]}} kg</td>
                <td>{{$info->info["ketuatu_saikou"]}} mmHg</td>
                <td>{{$info->info["ketuatu_saitei"]}} mmHg</td>
            </tr>
            @endif

            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(function() { 
        $("#sorter{{$base->index}}").tablesorter();
        //一致した行のみ表示
        function search_in_table(input_id,table_id){
            $("#"+input_id).keyup(function(){
                var re = new RegExp($(this).val());
                $("#"+table_id+" tbody tr").each(function(){
                    for(var i=0;i<$(this).find("td").length;i++){
                        var txt = $(this).find("td:eq("+i+")").text();
                        if(txt.match(re) != null){
                            $(this).show();
                            break;
                        }else{
                            $(this).hide();
                        }
                    }
                });
            });
        }
        //
        $(document).ready(function() { 
            search_in_table("search_in_table{{$base->index}}","sorter{{$base->index}}");
        });
    });
</script>
<script>
    $(function(){
	  
		  //利用者の名前検索
	var txt_array = [ "check11" , "check12" , "check13" , "check14" , "check15" , "check16" , "check17" , "check18" , "check19" , "check20" , "check21" , "check22" , "check23" , "check24" , "check25"];
	var re_array = [  "回答なし" , "良い" , "悪い"  , "普通" , 37 , 38 , "頭痛" , "鼻水" , "のどの痛み" , "関節や体がいたい" , "お腹" , "下痢" , "吐き気"];
	var check_array = ["a"];
	var shows;
	var j = 0;
	var i = 0;
	var l = 0;
        

	  
		//検索内容を取って判別する関数
	    $('#select_row_value{{$base->index}}').find('input[type="checkbox"]').change(function(){
			var re = new RegExp($('#search2').val());   //テキストに入れた文字を取得

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
            i = 2
            for(;i < 8;){
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
            var bad_ary = [""];
            var s = 0;
            for(var l = 8;l < txt_array.length;l++){
                bad_ary[s] = document.getElementById(txt_array[l]);
                s++;
            }
            if(bad_ary[0].checked == bad_ary[1].checked && bad_ary[0].checked == bad_ary[2].checked && bad_ary[0].checked == bad_ary[3].checked && bad_ary[0].checked == bad_ary[4].checked && bad_ary[0].checked == bad_ary[5].checked && bad_ary[0].checked == bad_ary[6].checked){
            }else{
                for(;i < txt_array.length;i++){
                    check1 = document.getElementById( txt_array[i] );
                    if( check1.checked == true ){
                        check_array[j] = i;
                        j++;
                    }
                }
            }
            i = 0;
            j = 0;
			$('.result2 tbody tr').each(function(){
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
					var txt1 = $(this).find("td:eq(2)").html();
					var check = document.getElementById( txt_array[2] );
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
				if( check_array[i] == 3){
					i++;
					var txt1 = $(this).find("td:eq(2)").html();
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
				if( check_array[i] == 4){
					i++;
					var txt1 = $(this).find("td:eq(2)").html();
					var check = document.getElementById( txt_array[4] );
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
				if( check_array[i] == 5){
					i++;
					var txt1 = $(this).find("input").val();
                    txt1 = Number(txt1);
					var check = document.getElementById( txt_array[5] );
					if( check.checked == true ){
						if( txt1 < re_array[4] ){
						}else{
							shows = "";
						}
					}else{
						if( txt1 < re_array[4] ){
							shows = "";
						}
					}
				}
				if( check_array[i] == 6){
					i++;
					var txt1 = $(this).find("input").val();
                    txt1 = Number(txt1);
					var check = document.getElementById( txt_array[6] );
					if( check.checked == true ){
					if( txt1 >= re_array[4] && txt1 < re_array[5] ){
                    }else{ 
                        shows = ""; 
                    }                        
					}else{
                        if( txt1 >= re_array[4] && txt1 < re_array[5] ){
                            shows = ""; 
                        }
					}
				}
				if( check_array[i] == 7){
					i++;
					var txt1 = $(this).find("input").val();
                    txt1 = Number(txt1);
					var check = document.getElementById( txt_array[7] );
					if( check.checked == true ){
						if( txt1 >= re_array[5] ){
                        }else{
                            shows = "";
                        }
					}else{
						if( txt1 >= re_array[5] ){
						    shows = "";
						}
					}
				}
                j = 8;
                for(;i < check_array.length;){
                    if( check_array[i] == j ){
                        i++;
                        var txt1 = $(this).find("td:eq(5)").html();
                        if( txt1.match(re_array[j-2]) != null ){
                            break;
                        }
                    }
                    j++;
                }
                if(j-2 >= re_array.length){
                    shows = "";
                }
                j = 0;
                  
				if( shows == this ){
					$(this).show();
				}else{
					$(this).hide();
				}
				  
	  
			});
			check_array = [""];
		});
	  
	  
		  //全て表示のボタン↓
		$('#button4').bind("click",function(){
            $("#search_in_table{{$base->index}}").val('');
			$('#search2').val('');
			$('.result2 tr').show();
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
