<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">平熱</td><td style="width: 70%">{{$base->info()->info["temp"]}}℃</td></tr>		
		<tr><td>身長</td><td>{{$base->info()->info["height"]}}cm</td></tr>		
		<tr><td>体重</td><td>{{$base->info()->info["weight"]}}kg</td></tr>		
		<tr><td>薬の使用状況</td><td>{{$base->info()->info["medicine"]}}</td></tr>
		<tr><td>アレルギー歴</td><td>{{$base->info()->info["allergy"]}}</td></tr>	
		<tr><td>既往歴</td><td>{{$base->info()->info["medical"]}}</td></tr>				
		<tr><td>手術歴</td><td>{{$base->info()->info["surgery"]}}</td></tr>				
		<tr><td>かかりつけの病院</td><td>{{$base->info()->info["hospital"]}}</td></tr>	
	</table>
</div>
