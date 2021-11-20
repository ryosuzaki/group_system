<?php

use App\Models\Group\Group;
use App\User;


return [
    /**
     * 
     */
    'group_types'=>[
        /*
        "type_name"=>[
            //表示名
            "name"=> "name",
            //初期にセットする情報　InfoTemplateのnameかidで指定
            "initial_info"=>[],
            //利用できるユーザの情報　InfoTemplateのnameかidで指定
            "available_user_info"=>[],
            //最初に作られるadminの設定
            "admin"=>[
                "name"=>"管理者",
            ],
            //権限の設定
            "permission"=>[
                //info_basesの操作の可否
                'group_info_bases'=>true,
                //rolesの操作の可否
                'group_roles'=>true,
            ],
        ]
        */
        'shelter'=>[
            "name"=> "避難所",
            "initial_info"=>[],
            "available_user_info"=>[],
            "admin"=>[
                "name"=>"管理者",
            ],
            "permission"=>[
                'group_info_bases'=>true,
                'group_roles'=>true,
            ],
        ],
        "danger_spot"=>[
            "name"=>"危険地点",
            "initial_info"=>[],
            "available_user_info"=>[],
            "admin"=>[
                "name"=>"作成者",
            ],
            "permission"=>[
                'group_info_bases'=>false,
                'group_roles'=>false,
            ],
        ],
    ],
    /**
     * 
     */
    'role'=>[
        'namespace'=>'App\Models\Components\Role',
        
        'group'=>['update','delete'],
        'group_info_bases'=>['viewAny','create','update','delete'],
        'group_info'=>['view','update'],
        'group_roles'=>['viewAny','create','update','delete'],
        'group_users'=>['permission','view','invite','remove'],

        'max_num_of_info_bases'=>10,
        'max_num_of_roles'=>10,
    ],

    /**
     * 
     */
    "info_templates"=>[
        "diss"=>[
            "info"=>[
                'default_name'=>'基本情報',
                'default_info'=>['body'=>''],
                'model'=>Group::class,
                'default_viewable'=>true,
                'description'=>'基本の情報表示',
                "default_edit"=>['name'=>'変更','icon'=>'<i class="material-icons">edit</i>'],
                "only_one"=>false,
                'view'=>[
                    'show'=>[
                        'path'=>'',
                    ],
                    'edit'=>[
                        'path'=>'',
                    ],
                ],
            ],
            "congestion"=>[
                "default_name"=>"混雑状況",
                'default_info'=>['degree'=>'0','color'=>"black",'detail'=>''],
                'model'=>Group::class,
                'default_viewable'=>true,
                'description'=>'混雑状況を表示します',
                "default_edit"=>['name'=>'変更','icon'=>'<i class="material-icons">edit</i>'],
                "only_one"=>false,
            ],
            "spot"=>[
                'default_name'=>'地点情報',
                'default_info'=>['type'=>'','detail'=>''],
                'model'=>Group::class,
                'default_viewable'=>true,
                'description'=>'地点情報を表示します',
                "default_edit"=>['name'=>'変更','icon'=>'<i class="material-icons">edit</i>'],
                "only_one"=>false,
            ],
            "notification"=>[
                'default_name'=>'お知らせ',
                'default_info'=>[],
                'model'=>Group::class,
                'default_viewable'=>true,
                'description'=>'お知らせ',
                'default_edit'=>['name'=>'送信','icon'=>'<i class="material-icons">mail_outline</i>'],
                "only_one"=>false,
            ],
            
        ],
    ],

    //
    'rescue'=>[
        'rescue'=>'救助中',
        'unrescue'=>'救助者がいません',
        'rescued'=>'救助完了',
        'user_rescue_info_template_id'=>6,
        'group_rescue_info_template_id'=>11,
    ],

    //
    'shelter'=>[
        'name'=>"避難所",
        'group_congestion_info_template_id'=>2,
    ],

    //
    'extra_group'=>[
        'good'=>'いいね',
        'check'=>'チェック',
    ],
    'good'=>'いいね',
    'check'=>'チェック',

    //
    'announcement'=>[
        'table'=>[
            'announcement'=>'announcement',
            'announcement_user'=>'announcement_user',
        ]
    ],


    'danger_spot'=>[
        'name'=>"危険地点",
        'spot_names'=>['土砂崩れ','水没','倒壊','火災','その他'],
    ],

    'info'=>[
        'template'=>[
            
        ],

    ]
];
