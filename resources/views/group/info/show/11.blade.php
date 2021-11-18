<div>
    <div class="form-group">
        <label>検索</label>
        <input class="form-control" type="text" id="search_in_table{{$base->index}}">
    </div>
    <input type="button" class="btn btn-primary btn-block" value="すべて表示" id="button2">
    <br>
        <div class="card m-0" id="selct_row_value{{$base->index}}">
            <ul class="list-unstyled">
                <li class="card-text list-unstyled">避難状況アンケート<br>
                    <label><input type="checkbox" id="check3" checked="checked">回答あり</label>
                    <label><input type="checkbox" id="check4" checked="checked">回答なし</label>
                </li>
                
                <li class="card-text list-unstyled">避難状況<br>
                    <label><input type="checkbox" id="check5" checked="checked">避難済み</label>
                    <label><input type="checkbox" id="check6" checked="checked">避難中</label>
                    <label><input type="checkbox" id="check7" checked="checked">要救助</label>
                </li>

                <li class="card-text list-unstyled">救助状況<br>
                    <label><input type="checkbox" id="check8" checked="checked">向かっていない</label>
                    <label><input type="checkbox" id="check9" checked="checked">救助中</label>
                    <label><input type="checkbox" id="check10" checked="checked">救助済み</label>
                </li>
            </ul>
        </div>

                
    <table class="card">
        <tr class="card-text">
            <td><label><input type="checkbox" id="time_check" onclick="checkbox_cell(this,'time')" checked="checked">回答日時</label></td>
            <td><label><input type="checkbox" id="where_check" onclick="checkbox_cell(this,'where')" checked="checked">位置情報</label></td>
            <td><label><input type="checkbox" id="comment_check" onclick="checkbox_cell(this,'comment')" checked="checked">コメント</label></td>
        </tr>
    </table>
</div>

<div class="table-responsive">
			

	<script>
	function embed_table(url){
		$.ajax({
			type:"get", 
			url:url,
			dataType: 'html',
		})
		.done((response)=>{
			$("#embed_info{{$base->index}}").html(response);
		})
		.fail((error)=>{
			console.log(error)
		})
	}
	</script>


    <table class="table text-nowrap tablesorter result1" id="sorter{{$base->index}}">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <th id="time">回答日時</th>
            <th>避難状況</th>
            <th>救助状況</th>
            <th id="where">位置情報</th>
            <th id="comment">コメント</th>
        </tr>
        </thead>
        <tbody>
			@php
			if(isset($rescue_collision_error)){
				alert($rescue_collision_error);
			}
            $users=$group->users()->get();
            @endphp
            @foreach ($users as $user)

				@php
				$info_base=$user->getInfoBaseByTemplate(config('kaigohack.rescue.user_rescue_info_template_id'));
				@endphp

				@if(!empty($info_base))

				<script>
				$(function(){
					$("#rescue{{$user->id}}").click(function(){
						embed_table("{{route('group.user.rescue',[$group->id,$user->id])}}");
					});
					$("#rescued{{$user->id}}").click(function(){
						embed_table("{{route('group.user.rescued',[$group->id,$user->id])}}");
					});
					$("#unrescue{{$user->id}}").click(function(){
						embed_table("{{route('group.user.unrescue',[$group->id,$user->id])}}");
					});
					$("#reverse_rescue{{$user->id}}").click(function(){
						embed_table("{{route('group.user.reverse_rescue',[$group->id,$user->id])}}");
					});
				});
				</script>

				@php
				$info=$info_base->info();
				$rescue=$info->info['rescue'];
				$rescuer=$info->info['rescuer'];
				$rescue_group=$info->info['group'];
				@endphp
				<tr>
					<td>{{$user->name}}</td>
					
					<td id="time_check">{{$info->info['last_answer']}}</td>
					<td>{{$info->info['evacuation']}}</td>
					<td>
					@if($rescue==config('kaigohack.rescue.rescue'))
						<a href="{{route('group.show',$rescue_group->id)}}">{{$rescue_group->name}}</a>の{{$rescuer->name}}が救助中
						@if($rescue_group->id==$group->id&&$rescuer->id==Auth::id())
						<a class="btn btn-danger btn-sm text-white m-0" id="unrescue{{$user->id}}"><i class="material-icons">close</i> 救助をやめる</a>
						<button type="button" data-toggle="modal" data-target="#rescued_modal{{$user->id}}" class="btn btn-success btn-sm text-white m-0"><i class="material-icons">done</i> 救助を完了</button>
						<div class="modal fade" id="rescued_modal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="rescuedLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-body">
										本当に{{$user->name}}さんの救助を完了しますか？
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
										<a class="btn btn-success text-white" id="rescued{{$user->id}}" data-dismiss="modal">救助を完了</a>
									</div>
								</div>
							</div>
						</div>
						@endif
					@elseif($rescue==config('kaigohack.rescue.unrescue'))
					<a class="btn btn-warning btn-sm text-white m-0" id="rescue{{$user->id}}">救助に向かう</a>
					@elseif($rescue==config('kaigohack.rescue.rescued'))
					<a href="{{route('group.show',$rescue_group->id)}}">{{$rescue_group->name}}</a>の{{$rescuer->name}}が救助済み
						@if($rescuer->id==Auth::id())
						<a class="btn btn-default btn-sm text-white m-0" id="reverse_rescue{{$user->id}}">元に戻す</a>
						@endif
					@endif
					</td>
					<td id="where_check"><a href="#">マップで表示</a></td>
					<td id="comment_check">{{$info->info['comment']}}</td>
				</tr>
				@endif
            @endforeach
			
        </tbody>
    </table>
</div>

<script>
	$(document).ready(function() { 
		$("#sorter{{$base->index}}").tablesorter();
	});
</script>
<script>
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
	function select_cell_value(table_id,column_id,cell_value){
		var column_idx=$("#"+column_id).eq();
		console.log(column_idx);
		$("#"+table_id+" tbody tr").each(function(){
			var txt = $(this).find("td:eq("+column_idx+")").text();
			if(txt==cell_value){
				$(this).show();
			}else{
				$(this).hide();
			}
		});
	}
	//
	function select_cell_range(table_id,column_id,min,max){
		var column_idx=$("#"+column_id).eq();
		console.log(column_idx);
		$("#"+table_id+" tbody tr").each(function(){
			var val=Number($(this).find("td:eq("+column_idx+")").text());
			if(val>=min&&val<=max){
				$(this).show();
			}else{
				$(this).hide();
			}
		});
	}
    $(document).ready(function() { 
        search_in_table("search_in_table{{$base->index}}","sorter{{$base->index}}");
    });
</script>
<script>
	$(function(){
	  

		  //利用者の名前検索
	var txt_array = [ "check3" , "check4" , "check5" , "check6" , "check7" , "check8" , "check9" , "check10"];
	var re_array = [  "回答なし" , "要救助" , "避難済み"  , "避難中" , "救助に向かう" , "救助済み" ];
	var find_array = ["time_check","shelter_check","comment_check","where_check"];
	var finds_array = ["time","shelter","comment","where"];
	var check_array = ["a"];
	var shows;
	var j = 0;
	var i = 0;
	var l = 0;
	  
			//検索内容を取って判別する関数
            $('#selct_row_value{{$base->index}}').find('input[type="checkbox"]').change(function(){
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
				check1 = document.getElementById( txt_array[2] );
				check2 = document.getElementById( txt_array[3] );
				var check3 = document.getElementById( txt_array[4] );
				if( check2.checked == check3.checked && check1.checked != check2.checked ){
					check_array[j] = 2;
					j++;
				}else if( check1.checked == check3.checked && check2.checked != check1.checked ){
					check_array[j] = 3;
					j++;
				}else if( check1.checked == check2.checked && check3.checked != check1.checked ){
					check_array[j] = 4;
					j++;
				}
                check1 = document.getElementById( txt_array[5] );
				check2 = document.getElementById( txt_array[6] );
				var check3 = document.getElementById( txt_array[7] );
				if( check2.checked == check3.checked && check1.checked != check2.checked ){
					check_array[j] = 5;
					j++;
				}else if( check1.checked == check3.checked && check2.checked != check1.checked ){
					check_array[j] = 6;
					j++;
				}else if( check1.checked == check2.checked && check3.checked != check1.checked ){
					check_array[j] = 7;
					j++;
				}				  
	  
			i = 0;
			j = 0;
			$('.result1 tbody tr').each(function(){
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
				if( check_array[i] == 5){
					i++;
					var txt1 = $(this).find("td:eq(3)").html();
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
				if( check_array[i] == 6){
					i++;
					var txt1 = $(this).find("td:eq(3)").html();
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
				if( check_array[i] == 7){
					i++;
					var txt1 = $(this).find("td:eq(3)").html();
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
            $("#search_in_table{{$base->index}}").val('');
			$('#search1').val('');
			$('.result1 tr').show();
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