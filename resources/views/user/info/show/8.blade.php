<div class="table-responsive">
    <table class="table text-nowrap">
		<tr><td style="width: 30%">氏名</td><td style="width: 70%">{{$base->info()->info["fami_name"]}}</td></tr>	
		<tr><td>性別</td><td>{{$base->info()->info["fami_sex"]}}</td></tr>			
		<tr><td>年齢</td><td>{{$base->info()->info["fami_age"]}}歳</td></tr>		
		<tr><td>続柄</td><td>{{$base->info()->info["fami_posi"]}}</td></tr>		
		<tr><td>住所</td><td>〒{{$base->info()->info["fami_post"]}}　{{$base->info()->info["fami_addr1"]}}{{$base->info()->info["fami_addr2"]}}</td></tr>	
		<tr><td>電話番号</td><td>{{$base->info()->info["fami_tel"]}}</td></tr>		
		<tr><td>メールアドレス</td><td>{{$base->info()->info["fami_mail"]}}</td></tr>		
	</table>
</div>
