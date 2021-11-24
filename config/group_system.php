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
        /*
        key=>valueのvalueにarrayでなく、stringで他のconfigのpathにすることで、外部ファイルを参照可能
        */
        "group_system"=>[
            Group::class=>[
                "info"=>[
                    'default_name'=>'情報',
                    'default_info'=>['body'=>""],
                    'default_viewable'=>true,
                    'description'=>'グループの情報を表示',
                    "default_edit"=>['name'=>'変更','icon'=>'<i class="material-icons">edit</i>'],
                    "only_one"=>false,
                    'view'=>[
                        'show'=>[
                            'path'=>'group.info.show.info',
                        ],
                        'edit'=>[
                            'path'=>'group.info.edit.info',
                        ],
                    ],
                ],
            ],
            User::class=>[
                "info"=>[
                    'default_name'=>'情報',
                    'default_info'=>['body'=>""],
                    'default_viewable'=>true,
                    'description'=>'ユーザーの情報を表示',
                    "default_edit"=>['name'=>'変更','icon'=>'<i class="material-icons">edit</i>'],
                    "only_one"=>false,
                    'view'=>[
                        'show'=>[
                            'path'=>'user.info.show.info',
                        ],
                        'edit'=>[
                            'path'=>'user.info.edit.info',
                        ],
                    ],
                ],
            ],
        ],
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
];
