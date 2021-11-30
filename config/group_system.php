<?php

use App\Models\Group\Group;
use App\User;


return [
    /**
     * 
     */
    'group_types'=>[
        "sample"=>[
            //表示名
            "name"=> "サンプル",
            //初期にセットする情報　InfoTemplateのnameかidで指定
            "initial_info"=>[],
            //
            "undeletable_info"=>[],
            //利用できるユーザの情報　InfoTemplateのnameかidで指定
            "viewable_user_infos"=>[],
            //最初に作られるadminの設定
            "admin"=>[
                "name"=>"管理者",
            ],
            //権限の設定
            "permission"=>[
                //infosの操作の可否
                'group_infos'=>true,
                //rolesの操作の可否
                'group_roles'=>true,
            ],
            //
            "available_index_view"=>true,
            //
            "available_create_view"=>true,
            //
            "view"=>[
                //
                "create"=>[
                    "path"=>"group.sample.create",
                ],
                //
            ],
        ]
    ],
    /**
     * 
     */
    'role'=>[
        'namespace'=>'App\Models\Role\Role',
        
        'group'=>['update','delete'],
        'group_infos'=>['viewAny','create','update','delete'],
        'group_info'=>['view','update'],
        'group_roles'=>['viewAny','create','update','delete'],
        'group_users'=>['permission','view','invite','remove'],

        'max_num_of_infos'=>10,
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
                    //名前の初期値
                    'default_name'=>'情報',
                    //infoの初期値
                    'default_info'=>['body'=>""],
                    //showを一般公開するかどうかの初期値　trueで一般公開する
                    'default_viewable'=>true,
                    //説明
                    'description'=>'グループの情報を表示',
                    //editページについて
                    "edit"=>['name'=>'変更','icon'=>'<i class="material-icons">edit</i>'],
                    //同じモデルに複数持てるか　trueで1つのみ
                    "only_one"=>false,
                    //viewについて
                    'view'=>[
                        'show'=>[
                            'path'=>'group.info.show.info',
                        ],
                        'edit'=>[
                            'path'=>'group.info.edit.info',
                        ],
                    ],
                    //infoが作成された直後に実行する関数 引数には作成されたinfoが渡される class名とfunction名を指定
                    'constructor'=>[
                        "class"=>User::class,
                        "function"=>"test_constructor",
                    ],
                ],
            ],
            User::class=>[
                "info"=>[
                    'default_name'=>'情報',
                    'default_info'=>['body'=>""],
                    'default_viewable'=>true,
                    'description'=>'ユーザーの情報を表示',
                    "edit"=>['name'=>'変更','icon'=>'<i class="material-icons">edit</i>'],
                    "only_one"=>false,
                    'view'=>[
                        'show'=>[
                            'path'=>'user.info.show.info',
                        ],
                        'edit'=>[
                            'path'=>'user.info.edit.info',
                        ],
                    ],
                    'constructor'=>[
                        "class"=>User::class,
                        "function"=>"test_constructor",
                    ],
                ],
            ],
        ],
    ],
];
