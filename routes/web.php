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

Route::get('/home', 'HomeController@index');

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

// タスク完了
Route::post('/task/{task}', 'TaskController@done');

// プロジェクトの変更
Route::get('/task/change/{project}', 'TaskController@change');

// Done Tasks

// 一覧画面
Route::get('/done', 'DoneController@index');

// doneのキャンセル
Route::post('/done/{task}', 'DoneController@cancel');

// User Feedback From

// 一覧画面
Route::get('/user_request', 'UserRequestController@index');

// リクエスト追加
Route::post('/user_request', 'UserRequestController@store');

// リクエスト削除
Route::delete('/user_request/{user_request}', 'UserRequestController@destroy');


// Projects

// 新規プロジェクト作成
Route::post('/project', 'ProjectController@store');

// タスク編集
Route::get('/project/edit/{project}', 'ProjectController@edit');