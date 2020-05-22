<?php

Route::get('/', function () {
    return '首页';
});

# 模型关联
Route::get('hasone', 'DemoController@hasone')->name('demo.hasone');



Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@login')->name('login');

// laravel后台的操作符合 restful规范
Route::group(['prefix' => 'user', 'middleware' => ['checklogin:admin']], function () {
    // 用户添加显示
    Route::get('create', 'UserController@create')->name('user.create');
    // 添加处理
    Route::post('create', 'UserController@store')->name('user.store');
    // 用户列表
    #Route::get('index', 'UserController@index')->name('user.index')->middleware(['checklogin']);
    Route::get('index', 'UserController@index')->name('user.index');

    // 修改显示
    Route::get('edit/{id}', 'UserController@edit')->name('user.edit');
    // 修改数据接受处理
    Route::put('edit/{id}', 'UserController@update')->name('user.update');

    // 删除操作
    Route::delete('del/{id}', 'UserController@destroy')->name('user.destroy');
    // 还原
    Route::get('restore/{id}', 'UserController@restore')->name('user.restore');
    // 永久删除
    Route::get('forever/{id}', 'UserController@forever')->name('user.forever');

    // 用户退出
    Route::get('logout', 'UserController@logout')->name('user.logout');

});
