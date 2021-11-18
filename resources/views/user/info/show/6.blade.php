@php
$info=$base->info()->info;
@endphp

<p class="h4">救助状況</p>
<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">救助状況</td><td style="width: 70%">{{$info["rescue"]}}</td></tr>			
		<tr><td>救助者</td><td>{{optional($info["group"])->name}} {{optional($info["rescuer"])->name}}</td></tr>
	</table>
</div>

<p class="h4">避難状況</p>
<div class="table-responsive">
	<table class="table text-nowrap"> 
        <tr><td style="width: 30%">回答日時</td><td style="width: 70%">{{$info["last_answer"]}}</td></tr>
		<tr><td>避難状況</td><td>{{$info["evacuation"]}}</td></tr>
        <tr><td>位置情報</td><td>{{$info["location"]["latitude"]}} {{$info["location"]["longitude"]}}</td></tr>	
		<tr><td>コメント</td><td>{{$info["comment"]}}</td></tr>	
	</table>
</div>




