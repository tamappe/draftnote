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

// Tasks

// 一覧画面
Route::get('/task', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('task.index', [
        'tasks' => $tasks
    ]);
});

// 新タスク追加
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()){
        return redirect('/task')->withInput()->withErrors($validator);
    }

    // タスク作成
    $task = new Task;
    $task->name = $request->name;
    $task->text = "サンプル";
    $task->save();

    return redirect('/task');
});

// タスク削除
Route::delete('/task/{task}', function (Task $task) {

});

