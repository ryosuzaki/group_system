<?php

use App\Models\Group\GroupType;
use App\Models\Group\Group;
use App\User;

use App\Models\Info\Info;

use Illuminate\Support\Facades\Auth;

//
Breadcrumbs::for('home', function ($trail) {
    $trail->push('ホーム', route('home'));
});

//
Breadcrumbs::for('home.group_type', function ($trail,GroupType $type) {
    $trail->parent('home');
    $trail->push($type->getName(), route('home.group_type',$type));
});



//
Breadcrumbs::for('group.show', function ($trail,Group $group) {
    $trail->parent('home.group_type',$group->getType());
    $trail->push($group->name, route('group.show',$group));
});
//
Breadcrumbs::for('group.create', function ($trail,GroupType $type) {
    $trail->parent('home.group_type',$type);
    $trail->push('作成', route('group.create',$type));
});
//
Breadcrumbs::for('group.edit', function ($trail,Group $group) {
    $trail->parent('group.show',$group);
    $trail->push('変更・削除', route('group.edit', $group));
});



//
Breadcrumbs::for('group.role.index', function ($trail,Group $group) {
    $trail->parent('group.show', $group);
    $trail->push('役割', route('group.role.index', $group));
});

//
Breadcrumbs::for('group.role.create', function ($trail,Group $group) {
    $trail->parent('group.role.index', $group);
    $trail->push('追加', route('group.role.create', $group));
});

//
Breadcrumbs::for('group.role.edit', function ($trail,Group $group,int $index) {
    $trail->parent('group.role.index',$group);
    $trail->push('変更', route('group.role.edit',[$group,$index]));
});
//
Breadcrumbs::for('group.role.edit_permissions', function ($trail,Group $group,int $index) {
    $trail->parent('group.role.index',$group);
    $trail->push('権限', route('group.role.edit_permissions',[$group,$index]));
});


//
Breadcrumbs::for('group.user.index', function ($trail,Group $group,int $index) {
    $trail->parent('group.role.index', $group);
    $trail->push('ユーザー', route('group.user.index',[$group,$index]));
});

//
Breadcrumbs::for('group.user.create', function ($trail,Group $group,int $index) {
    $trail->parent('group.user.index', $group,$index);
    $trail->push('招待', route('group.user.create',[$group,$index]));
});

//
Breadcrumbs::for('group.user.show', function ($trail,Group $group,User $user,int $index) {
    $trail->parent('group.user.index',$group,$index);
    $trail->push($user->name, route('group.user.show',[$group,$user,$index]));
});




//
Breadcrumbs::for('group.info.edit', function ($trail,Group $group,int $index) {
    $trail->parent('group.show',$group);
    $trail->push($group->getInfoByIndex($index)->name, route('group.info.edit',[$group,$index]));
});



//
Breadcrumbs::for('group.infos.index', function ($trail,Group $group) {
    $trail->parent('group.show',$group);
    $trail->push('情報', route('group.infos.index',$group));
});
//
Breadcrumbs::for('group.infos.create', function ($trail,Group $group) {
    $trail->parent('group.infos.index',$group);
    $trail->push('追加', route('group.infos.create',$group));
});
//
Breadcrumbs::for('group.infos.edit', function ($trail,Group $group,int $index) {
    $trail->parent('group.infos.index',$group);
    $trail->push('変更', route('group.infos.edit',[$group,$index]));
});







//
Breadcrumbs::for('user.show', function ($trail) {
    $trail->parent('home');
    $trail->push(Auth::user()->name, route('user.show'));
});
//
Breadcrumbs::for('user.edit', function ($trail) {
    $trail->parent('user.show');
    $trail->push('変更', route('user.edit'));
});

//
Breadcrumbs::for('user.info.edit', function ($trail,Info $info) {
    $trail->parent('user.show');
    $trail->push($info->name, route('user.info.edit',$info));
});

//
Breadcrumbs::for('user.infos.index', function ($trail) {
    $trail->parent('user.show');
    $trail->push('情報', route('user.infos.index'));
});
//
Breadcrumbs::for('user.infos.create', function ($trail) {
    $trail->parent('user.infos.index');
    $trail->push('追加', route('user.infos.create'));
});
//
Breadcrumbs::for('user.infos.edit', function ($trail,Info $info) {
    $trail->parent('user.infos.index');
    $trail->push('変更', route('user.infos.edit',$info));
});

//
Breadcrumbs::for('user.group.index', function ($trail) {
    $trail->parent('user.show');
    $trail->push('グループ', route('user.group.index'));
});
//
Breadcrumbs::for('user.group.create', function ($trail) {
    $trail->parent('user.group.index');
    $trail->push('追加', route('user.group.create'));
});
//
Breadcrumbs::for('user.group.edit', function ($trail,Group $group) {
    $trail->parent('user.group.index');
    $trail->push('変更', route('user.group.edit',$group));
});

/*
Breadcrumbs::for('user.announcement.index', function ($trail) {
    $trail->parent('user.show');
    $trail->push('お知らせ', route('user.announcement.index'));
});
//
Breadcrumbs::for('user.announcement.show', function ($trail,$announcement) {
    $trail->parent('user.announcement.index');
    $trail->push($announcement->data['announcement']['title']);
});