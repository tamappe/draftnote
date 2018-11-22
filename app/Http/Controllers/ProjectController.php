<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Task;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProjectController extends Controller
{
    //
    public function store(Request $request)
    {
        // マイグレーション処理
        $this->migrate_first_project();

        // 2つ目以降のプロジェクトの作成
        // バリデーション
        $messages = [
            'title.required' => 'プロジェクト名を入力してください',
        ];
        $rules = [
            'title' => 'required|max:255'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/tasks')
                ->withErrors($validator)
                ->withInput();
        }

        // プロジェクト作成
        $project = new Project();
        $project->user_id = Auth::id();
        $project->title = $request->title;
        $project->save();

        $user = Auth::user();
        $user->current_project_id = $project->id;
        $user->update();
        
        return redirect('/tasks');
    }

    private function migrate_first_project()
    {
        // マイグレーションのため、Projectの個数が0の場合にはname:None用のIDを作成する
        $projects = Project::get();
        $user_projects = User::find(Auth::id())->projects;
        if ($user_projects->isEmpty()) {
            $user_tasks = Task::where('user_id', Auth::id())->get();
            if (count($user_tasks) > 0) {
                // プロジェクト作成
                $first_project = new Project();
                $first_project->user_id = Auth::id();
                $first_project->title = 'First Project';
                $first_project->save();
                foreach ($user_tasks as $task) {
                    $task->project_id = count($projects) + 1;
                    $task->update();
                }
            }
        }
    }

    public function edit(Request $request, Project $project)
    {
        $project->title = $request->title;
        $project->update();
        return redirect('/tasks');
    }
}
