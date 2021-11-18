<?php

return [
    //
    'unique_name'=>'group',
    //
    'creator'=>'作成者',
    //
    'role'=>[
        'namespace'=>'App\Models\Components\Role',
        
        'group'=>['update','delete'],
        'group_info_bases'=>['viewAny','create','update','delete'],
        'group_info'=>['view','update'],
        'group_roles'=>['viewAny','create','update','delete'],
        'group_users'=>['permission','view','invite','remove'],
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
