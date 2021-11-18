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
			<div class="table-responsive">
				<table class="table text-nowrap"> 
					<tr><td style="width: 30%">性別</td><td style="width: 70%">{{$base->info()->info["you_sex"]}}</td></tr>			
					<tr><td>生年月日</td><td>{{$base->info()->info["you_year"]}}年  {{$base->info()->info["you_month"]}}月  {{$base->info()->info["you_day"]}}日</td></tr>	
					<tr><td>住所</td><td>〒{{$base->info()->info["you_post"]}}　　{{$base->info()->info["you_addr1"]}}{{$base->info()->info["you_addr2"]}}</td></tr>	
					<tr><td>電話番号</td><td>{{$base->info()->info["you_tel"]}}</td></tr>	
				</table>
			</div>
		</div>
		<div class="tab-pane" id="2">
			<h2>緊急連絡先</h2>
			<div class="table-responsive">
				<table class="table text-nowrap">
					<tr><td style="width: 30%">氏名</td><td style="width: 70%">{{$base->info()->info["fami_name"]}}</td></tr>	
					<tr><td>生年月日</td><td>{{$base->info()->info["fami_year"]}}年  {{$base->info()->info["fami_month"]}}月  {{$base->info()->info["fami_day"]}}日</td></tr>	
					<tr><td>続柄</td><td>{{$base->info()->info["fami_posi"]}}</td></tr>		
					<tr><td>住所</td><td>〒{{$base->info()->info["fami_post"]}}　{{$base->info()->info["fami_addr1"]}}{{$base->info()->info["fami_addr2"]}}</td></tr>	
					<tr><td>電話番号</td><td>{{$base->info()->info["fami_tel"]}}</td></tr>		
					<tr><td>メールアドレス</td><td>{{$base->info()->info["fami_mail"]}}</td></tr>		
				</table>
			</div>
		</div>

		<div class="tab-pane" id="3">
			<h2>その他</h2>
			<div class="table-responsive">
				<table class="table text-nowrap"> 
					<tr><td style="width: 30%">最寄りの避難場所</td><td style="width: 70%">{{$base->info()->info["shelter"]}}</td></tr>	
					<tr><td>平熱</td><td>{{$base->info()->info["temp"]}}℃</td></tr>		
					<tr><td>身長</td><td>{{$base->info()->info["height"]}}cm</td></tr>		
					<tr><td>薬の使用状況</td><td>{{$base->info()->info["medicine"]}}</td></tr>
					<tr><td>アレルギー歴</td><td>{{$base->info()->info["allergy"]}}</td></tr>	
					<tr><td>既往歴</td><td>{{$base->info()->info["medical"]}}</td></tr>				
					<tr><td>手術歴</td><td>{{$base->info()->info["surgery"]}}</td></tr>				
					<tr><td>かかりつけの病院</td><td>{{$base->info()->info["hospital"]}}</td></tr>
					<tr><td>福祉用具(杖や車いす等)使用の有無</td><td>{{$base->info()->info["tools"]}}</td></tr>	
					<tr><td>同居人の有無</td><td>{{$base->info()->info["housemate"]}}</td></tr>
					<!--  ここからの情報は介護事業者側も入力可能の情報  -->
					<tr><td>障害の有無</td><td>{{$base->info()->info["hindrance"]}}</td></tr>		
					<tr><td>障害の内容</td><td>{{$base->info()->info["hindrance_contents"]}}</td></tr>			
					<tr><td>電源の要不要</td><td>{{$base->info()->info["volt"]}}</td></tr>
					<tr><td>電源の用途</td><td>{{$base->info()->info["volt_contents"]}}</td></tr>
					<tr><td>介護サービスの有無</td><td>{{$base->info()->info["service"]}}</td></tr>		
					<tr><td>サービス内容</td><td>{{$base->info()->info["use_service"]}}</td></tr>		
					<tr><td>特記事項記入欄（自由コメント欄）</td><td>{{$base->info()->info["comment"]}}</td></tr>										
				</table>
			</div>
		</div>

	</div>
</div>

