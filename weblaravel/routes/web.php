<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('demo/index', 'Demo2Controller@index');
// Route::get('admin/login', 'Admin\LoginController@login');
Route::get('login', 'Login\LoginController@index')->name('login');
Route::post('login', 'Login\LoginController@login')->name('login');
// Route::get('/test', function () {
//     // return view('我他娘的是get！');
//     echo '我他娘的是get！';
// });
// Route::post('/test', function () {
//         // return view('我他娘的是get！');
//         echo '我他娘的是post！';
// });
// Route::match(['get','post'],'/test',function () {
//         // return view('我他娘的是get！');
//         echo '我他娘的是post！';
// });

// Route::any('/test', function () {
//         // return view('我他娘的是get！');
//         echo '我他娘的是post！';
// });

// Route::get('a', function () {
//     // return view('我他娘的是get！');
//    return '<a href="'.route('b',['id'=>100]).'">去b页面</a>';
// })->name('a');

// Route::get('b/{id}', function () {
//     // return view('我他娘的是get！');
//    return '<a href="'.route('a').'">去b页面</a>';
// })->name('b');
