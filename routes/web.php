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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ルーティング
Route::get('/', function (){
    return redirect('/tasks');
});

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

