<?php

//
Route::name('user.')->prefix('user')->namespace('User')->middleware('auth')->group(function(){
    //
    Route::get('show/{index?}', 'UserController@show')->name('show');
    Route::get('get_info/{index?}', 'UserController@getInfo')->name('get_info');
    Route::get('edit', 'UserController@edit')->name('edit');
    Route::put('update', 'UserController@update')->name('update');

    //
    //Route::get('initial_setting_form', 'UserController@initialSettingForm')->name('initial_setting_form');
    //Route::post('initial_setting', 'UserController@initialSetting')->name('initial_setting');

    //
    Route::get('{info_base}/info/edit', 'UserInfoController@edit')->name('info.edit');
    Route::put('{info_base}/info', 'UserInfoController@update')->name('info.update');

   
    //
    Route::get('group', 'UserGroupController@index')->name('group.index');
    Route::get('group/create', 'UserGroupController@create')->name('group.create');
    Route::post('group', 'UserGroupController@store')->name('group.store');
    Route::get('group/{group}/edit', 'UserGroupController@edit')->name('group.edit');
    Route::put('group/{group}', 'UserGroupController@update')->name('group.update');
    Route::delete('group/{group}', 'UserGroupController@destroy')->name('group.destroy');
    //
    Route::get('group/{group}/accept_join_request', 'UserGroupController@acceptJoinRequest')->name('group.accept_join_request');
    Route::get('group/{group}/denied_join_request', 'UserGroupController@deniedJoinRequest')->name('group.denied_join_request');

    //
    Route::get('info_base', 'UserInfoBaseController@index')->name('info_base.index');
    Route::get('info_base/create', 'UserInfoBaseController@create')->name('info_base.create');
    Route::post('info_base', 'UserInfoBaseController@store')->name('info_base.store');
    Route::get('info_base/{info_base}/edit', 'UserInfoBaseController@edit')->name('info_base.edit');
    Route::put('info_base/{info_base}', 'UserInfoBaseController@update')->name('info_base.update');
    Route::delete('info_base/{info_base}', 'UserInfoBaseController@destroy')->name('info_base.destroy');
});

//
Route::name('user.')->prefix('user')->namespace('User/Components')->middleware('auth')->group(function(){
    //
    Route::get('announcement/markAsReadAll', 'AnnouncementController@markAsReadAll')->name('announcement.markAsReadAll');
    //
    Route::resource('announcement', 'AnnouncementController',['only' => [
        'index','show','destroy'
    ]]);

    //
    Route::put('{info_base}/questionnaire', 'QuestionnaireController@update')->name('questionnaire.update');
    Route::get('{info_base}/questionnaire/setting_form', 'QuestionnaireController@settingForm')->name('questionnaire.setting_form');
    Route::post('{info_base}/questionnaire/setting', 'QuestionnaireController@setting')->name('questionnaire.setting');

    //
    Route::resource('setting', 'SettingController');
});

//
Route::name('group.')->prefix('group')->namespace('Group')->middleware('auth')->group(function(){
    //
    Route::get('create/{type}', 'GroupController@create')->name('create');
    Route::post('store/{type}', 'GroupController@store')->name('store');
    Route::post('store_with_location/{type}', 'GroupController@storeWithLocation')->name('store_with_location');

    //
    Route::namespace('Components')->group(function(){
        Route::get('location/index/{group_types}', 'LocationController@index')->name('location.index');
        Route::get('map/shelter_and_danger_spot', 'MapController@mapShelterAndDangerSpot')->name('map.shelter_and_danger_spot');
    });

    //
    Route::prefix('{group}')->group(function(){
        //
        Route::get('show/{index?}', 'GroupController@show')->name('show');
        Route::get('get_info/{index?}', 'GroupController@getInfo')->name('get_info');
        //
        Route::get('user/index/{index?}', 'GroupUserController@index')->name('user.index');
        Route::get('user/create/{index}', 'GroupUserController@create')->name('user.create');
        Route::post('user/{index}', 'GroupUserController@store')->name('user.store');
        Route::get('user/{user}/show/{index}', 'GroupUserController@show')->name('user.show');
        Route::delete('user/{user}/{index}', 'GroupUserController@destroy')->name('user.destroy');
        //
        Route::post('user/{index}/store_by_csv', 'GroupUserController@storeByCsv')->name('user.store_by_csv');
        Route::get('user/{user}/quit_request_join/{index}', 'GroupUserController@quitRequestJoin')->name('user.quit_request_join');

        //
        Route::get('info/{index}/edit', 'GroupInfoController@edit')->name('info.edit');
        Route::put('info/{index}', 'GroupInfoController@update')->name('info.update');

        //
        Route::namespace('Components')->group(function(){
            //
            Route::get('map/get_info_window_html', 'MapController@getInfoWindowHtml')->name('map.get_info_window_html');
            //    
            Route::get('location/show', 'LocationController@show')->name('location.show');
            Route::get('location/edit', 'LocationController@edit')->name('location.edit');
            Route::put('location', 'LocationController@update')->name('location.update');
            Route::post('location/set_here', 'LocationController@setHere')->name('location.set_here');
            //
            Route::put('announcement/send', 'AnnouncementController@send')->name('announcement.send');
            Route::get('announcement/{announcement}/show', 'AnnouncementController@show')->name('announcement.show');

            //
            Route::post('uploadImg', 'UploadController@uploadImg')->name('uploadImg');
            Route::delete('deleteImg', 'UploadController@deleteImg')->name('deleteImg');
            
            //
            Route::get('extra_group/set/{extra_name}', 'ExtraGroupController@set')->name('extra_group.set');
            Route::get('extra_group/unset/{extra_name}', 'ExtraGroupController@unset')->name('extra_group.unset');

            //
            Route::get('user/{user}/rescue', 'RescueController@rescue')->name('user.rescue');
            Route::get('user/{user}/unrescue', 'RescueController@unrescue')->name('user.unrescue');
            Route::get('user/{user}/rescued', 'RescueController@rescued')->name('user.rescued');
            Route::get('user/{user}/reverse_rescue', 'RescueController@reverseRescue')->name('user.reverse_rescue');
            //
            Route::get('permission/{index}/edit', 'PermissionController@edit')->name('permission.edit');
            Route::put('permission/{index}', 'PermissionController@update')->name('permission.update');
        });
    });
});

//
Route::resource('group', 'Group\GroupController',['except' => ['create','show','store']]);
//
Route::resource('group.role', 'Group\Components\RoleController');
//
Route::resource('group.info_base', 'Group\GroupInfoBaseController');