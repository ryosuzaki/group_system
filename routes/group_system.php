<?php

//
Route::name('user.')->prefix('user')->namespace('User')->middleware('auth')->group(function(){
    //
    Route::get('show/{index?}', 'UserController@show')->name('show');
    Route::get('get_info/{index?}', 'UserController@getInfo')->name('get_info');
    Route::get('edit', 'UserController@edit')->name('edit');
    Route::put('update', 'UserController@update')->name('update');

    //
    Route::name('info.')->prefix('info')->group(function(){
        Route::get('{info}/edit', 'UserInfoController@edit')->name('edit');
    });

   
    //
    Route::name('group.')->prefix('group')->group(function(){
        Route::get('', 'UserGroupController@index')->name('index');
        //Route::get('create', 'UserGroupController@create')->name('create');
        //Route::post('', 'UserGroupController@store')->name('store');
        Route::prefix('{group}')->group(function(){
            //Route::get('/edit', 'UserGroupController@edit')->name('edit');
            //Route::put('', 'UserGroupController@update')->name('update');
            Route::delete('', 'UserGroupController@destroy')->name('destroy');
            //
            Route::get('/accept_join_request', 'UserGroupController@acceptJoinRequest')->name('accept_join_request');
            Route::get('/denied_join_request', 'UserGroupController@deniedJoinRequest')->name('denied_join_request');
        });
    });

    //
    Route::name('infos.')->prefix('infos')->group(function(){
        Route::get('', 'UserInfosController@index')->name('index');
        Route::get('create', 'UserInfosController@create')->name('create');
        Route::post('', 'UserInfosController@store')->name('store');
        Route::prefix('{info}')->group(function(){
            Route::get('edit', 'UserInfosController@edit')->name('edit');
            Route::put('', 'UserInfosController@update')->name('update');
            Route::delete('', 'UserInfosController@destroy')->name('destroy');
        });
    });
});



//
Route::name('group.')->prefix('group')->namespace('Group')->middleware('auth')->group(function(){
    //
    Route::get('home/{type}', 'GroupController@home')->name('home');
    Route::get('{type}', 'GroupController@index')->name('index');
    Route::get('create/{type}', 'GroupController@create')->name('create');
    Route::post('store/{type}', 'GroupController@store')->name('store');
    //Route::post('store_with_location/{type}', 'GroupController@storeWithLocation')->name('store_with_location');

    //
    Route::prefix('{group}')->group(function(){
        //
        Route::get('show/{index?}', 'GroupController@show')->name('show');
        Route::get('get_info/{index?}', 'GroupController@getInfo')->name('get_info');
        Route::get('edit', 'GroupController@edit')->name('edit');
        Route::put('', 'GroupController@update')->name('update');
        Route::delete('', 'GroupController@destroy')->name('destroy');
        //
        Route::name('user.')->prefix('user')->group(function(){
            Route::get('{index?}', 'GroupUserController@index')->name('index');
            Route::get('create/{index}', 'GroupUserController@create')->name('create');
            Route::post('{index}', 'GroupUserController@store')->name('store');
            Route::get('{index}/show/{user}', 'GroupUserController@show')->name('show');
            Route::delete('{index}/{user}', 'GroupUserController@destroy')->name('destroy');
            //
            Route::post('{index}/store_by_csv', 'GroupUserController@storeByCsv')->name('store_by_csv');
            Route::get('{index}/quit_request_join/{user}', 'GroupUserController@quitRequestJoin')->name('quit_request_join');
        });
        

        //
        Route::name('info.')->prefix('info')->group(function(){
            Route::get('{index}/edit', 'GroupInfoController@edit')->name('edit');
        });
        

        //
        Route::name('role.')->prefix('role')->group(function(){
            Route::get('', 'GroupRoleController@index')->name('index');
            Route::get('create', 'GroupRoleController@create')->name('create');
            Route::post('', 'GroupRoleController@store')->name('store');
            Route::get('{index}/edit', 'GroupRoleController@edit')->name('edit');
            Route::put('{index}', 'GroupRoleController@update')->name('update');
            Route::delete('{index}', 'GroupRoleController@destroy')->name('destroy');
            Route::get('{index}/edit_permissions', 'GroupRoleController@editPermissions')->name('edit_permissions');
            Route::put('{index}/update_permissions', 'GroupRoleController@updatePermissions')->name('update_permissions');
        });
        
        //
        Route::name('infos.')->prefix('infos')->group(function(){
            Route::get('', 'GroupInfosController@index')->name('index');
            Route::get('create', 'GroupInfosController@create')->name('create');
            Route::post('', 'GroupInfosController@store')->name('store');
            Route::get('{info}/edit', 'GroupInfosController@edit')->name('edit');
            Route::put('{info}', 'GroupInfosController@update')->name('update');
            Route::delete('{info}', 'GroupInfosController@destroy')->name('destroy');
        });
    });
});


