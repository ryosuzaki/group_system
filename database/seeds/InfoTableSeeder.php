<?php

use Illuminate\Database\Seeder;

use App\Models\Info\InfoTemplate;

use App\Models\Group\Group;
use App\User;

class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InfoTemplate::setUp();
    
        /*
        //
        InfoTemplate::create([
            'id' => 1,
            'name' => '基本情報',
            'default'=>['body'=>''],
            'model'=>Group::class,
            'detail'=>'基本の情報表示',
        ]);

        InfoTemplate::create([
            'id' => 2,
            'name' => '混雑状況',
            'default'=>['degree'=>'0','color'=>"black",'detail'=>''],
            'model'=>Group::class,
            'detail'=>'混雑状況を表示します',
        ]);

        InfoTemplate::create([
            'id' => 3,
            'name' => '地点情報',
            'default'=>['type'=>'','detail'=>''],
            'model'=>Group::class,
            'detail'=>'地点情報を表示します',
        ]);

         InfoTemplate::create([
            'id' => 4,
            'name' => '利用者情報',
            'default'=>['you_sex'=>'','you_year'=>'','you_month'=>'','you_day'=>'','you_post'=>'','you_addr1'=>'','you_addr2'=>'','you_tel'=>'',
            'fami_name'=>'','fami_year'=>'','fami_month'=>'','fami_day'=>'','fami_posi'=>'','fami_post'=>'','fami_addr1'=>'','fami_addr2'=>'','fami_tel'=>'','fami_mail'=>'',
            'shelter'=>'','temp'=>'','height'=>'','medicine'=>'','allergy'=>'','medical'=>'','surgery'=>'','hospital'=>'','tools'=>'',
            'housemate'=>'','hindrance'=>'','hindrance_contents'=>'','volt'=>'','volt_contents'=>'','service'=>'','use_service'=>'','institution'=>'','comment'=>''
            ],
            'model'=>User::class,
            'detail'=>'利用者情報',
        ]);


        InfoTemplate::create([
            'id' => 5,
            'name' => '健康記録',
            'default'=>['not_use_items'=>[],'feeling'=>'回答なし','comment'=>'','syokuyoku'=>'','otuzi'=>'','taion'=>'','taiju'=>'','ketuatu_saikou'=>'','ketuatu_saitei'=>'','warui_bui'=>['']],
            'model'=>User::class,
            'detail'=>'健康',
            'edit'=>['name'=>'回答','icon'=>'<i class="material-icons">question_answer</i>'],
        ]);

        InfoTemplate::create([
            'id' => config('kaigohack.rescue.user_rescue_info_template_id'),
            'name' => '避難/救助状況',
            'default'=>['rescue'=>config('kaigohack.rescue.unrescue'),'group'=>"",'rescuer'=>"",'evacuation'=>'回答なし','last_answer'=>'','comment'=>'','location'=>['latitude'=>'','longitude'=>'']],
            'model'=>User::class,
            'detail'=>'救助状況',
            'edit'=>['name'=>'回答','icon'=>'<i class="material-icons">question_answer</i>'],
        ]);

        InfoTemplate::create([
            'id' => 7,
            'name' => 'お知らせ',
            'default'=>[],
            'model'=>Group::class,
            'viewable'=>true,
            'detail'=>'お知らせ',
            'edit'=>['name'=>'送信','icon'=>'<i class="material-icons">mail_outline</i>'],
        ]);

        InfoTemplate::create([
            'id' => 8,
            'name' => '家族情報',
            'default'=>['fami_name'=>'','fami_sex'=>'','fami_age'=>'','fami_posi'=>'','fami_post'=>'','fami_addr1'=>'','fami_addr2'=>'','fami_tel'=>'','fami_mail'=>''],
            'model'=>User::class,
            'detail'=>'家族情報',
        ]);

        InfoTemplate::create([
            'id' => 9,
            'name' => '医療',
            'default'=>['temp'=>'','height'=>'','weight'=>'','medicine'=>'','allergy'=>'','medical'=>'','surgery'=>'','hospital'=>''],
            'model'=>User::class,
            'detail'=>'医療',
        ]);
        
        InfoTemplate::create([
            'id' => 10,
            'name' => '福祉',
            'default'=>['hindrance'=>'','nursing'=>'','caregiver'=>'','caregiver_posi'=>'','service'=>'','use_service'=>'','institution'=>'','oxygen'=>'','assistance'=>'','housemate'=>'','shelter'=>''],
            'model'=>User::class,
            'detail'=>'福祉',
        ]);
        
        InfoTemplate::create([
            'id' => config('kaigohack.rescue.group_rescue_info_template_id'),
            'name' => '避難/救助状況',
            'default'=>[],
            'viewable'=>false,
            'model'=>Group::class,
            'edit'=>[],
        ]);

        InfoTemplate::create([
            'id' => 12,
            'name' => '健康記録',
            'default'=>[],
            'viewable'=>false,
            'model'=>Group::class,
            'edit'=>[],
        ]);
        */
    }
}
