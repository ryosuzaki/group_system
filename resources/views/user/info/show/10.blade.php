<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">障害の有無</td><td style="width: 70%">{{$base->info()->info["hindrance"]}}</td></tr>		
		<tr><td>要支援・要介護認定</td><td>{{$base->info()->info["nursing"]}}</td></tr>			
		<tr><td>介護者の有無</td><td>{{$base->info()->info["caregiver"]}}</td></tr>
		<tr><td>介護者の続柄</td><td>{{$base->info()->info["caregiver_posi"]}}</td></tr>		
		<tr><td>介護サービスの有無</td><td>{{$base->info()->info["service"]}}</td></tr>		
		<tr><td>サービス内容</td><td>{{$base->info()->info["use_service"]}}</td></tr>		
		<tr><td>利用サービス施設名称</td><td>{{$base->info()->info["institution"]}}</td></tr>	
		<tr><td>在宅酸素療法</td><td>{{$base->info()->info["oxygen"]}}</td></tr>		
		<tr><td>介助者</td><td>{{$base->info()->info["assistance"]}}</td></tr>			
	</table>
</div>

<p class="h3">住まい</p>	
<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">同居人の有無</td><td style="width: 70%">{{$base->info()->info["housemate"]}}</td></tr>			
		<tr><td>最寄りの避難場所</td><td>{{$base->info()->info["shelter"]}}</td></tr>	
	</table>
</div>

