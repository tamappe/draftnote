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

use App\Task;
use Illuminate\Http\Request;

$user_path = Config::get('const.user_path');

Auth::routes();

Route::get('/home', 'UserController@index');

// ルーティング
Route::get('/', function (){
    return redirect('/user/tasks');
});

// ログアウト
Route::get('/logout', 'UserController@logout');

// Tasks

// 一覧画面
Route::get('/tasks', 'TaskController@index');

// 新タスク追加
Route::post('/task', 'TaskController@store');

// タスク削除
Route::delete('/task/{task}', 'TaskController@destroy');

// タスク編集
Route::get('/task/edit/{task}', 'TaskController@edit');

// タスク更新
Route::post('/task/edit', 'TaskController@update');

// Users

// 一覧画面
Route::get($user_path . '/tasks', 'UserController@index');

// 新タスク追加
Route::post($user_path . '/task', 'UserController@store');

// タスク削除
Route::delete($user_path . '/task/{task}', 'UserController@destroy');

// タスク編集
Route::get('/user/task/edit/{task}', 'UserController@edit');

// タスク更新
Route::post($user_path . '/task/edit', 'UserController@update');