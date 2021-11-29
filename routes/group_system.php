<?php

//
Route::name('user.')->prefix('user')->namespace('User')->middleware('auth')->group(function(){
    //
    Route::get('show/{index?}', 'UserController@show')->name('show');
    Route::get('edit', 'UserController@edit')->name('edit');
    Route::put('update', 'UserController@update')->name('update');

    //
    Route::get('info/{info}/edit', 'UserInfoController@edit')->name('info.edit');
    Route::get('get_info/{index?}', 'UserInfoController@getInfoView')->name('get_info');
    //Route::put('{info}/info', 'UserInfoController@update')->name('info.update');

   
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
    Route::get('{type}', 'GroupController@index')->name('index');
    Route::get('create/{type}', 'GroupController@create')->name('create');
    Route::post('store/{type}', 'GroupController@store')->name('store');
    //Route::post('store_with_location/{type}', 'GroupController@storeWithLocation')->name('store_with_location');

    //
    Route::prefix('{group}')->group(function(){
        //
        Route::get('show/{index?}', 'GroupController@show')->name('show');
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
        Route::get('info/{index}/edit', 'GroupInfoController@edit')->name('info.edit');
        Route::get('get_info/{index?}', 'GroupInfoController@getInfoView')->name('get_info');

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

















/*


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
    Route::namespace('Components')->group(function(){
        Route::get('location/index/{group_types}', 'LocationController@index')->name('location.index');
        Route::get('map/shelter_and_danger_spot', 'MapController@mapShelterAndDangerSpot')->name('map.shelter_and_danger_spot');
    });

    //
    Route::prefix('{group}')->group(function(){
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
            
        });
    });

});