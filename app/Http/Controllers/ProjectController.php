<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Task;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    //
    public function store(Request $request)
    {
        // マイグレーションのため、Projectの個数が0の場合にはname:None用のIDを作成する
        $projects = Project::get();
        $user_projects = User::find(Auth::id())->projects;
        if ($user_projects->isEmpty()) {
            $user_tasks = Task::where('user_id', Auth::id())->get();

            foreach ($user_tasks as $task) {
                $task->project_id = count($projects) + 1;
                $task->update();
            }
        }

        // 2つ目以降のプロジェクトの作成

        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        // プロジェクト作成
        $project = new Project();
        $project->user_id = Auth::id();
        $project->name = $request->name;
        $project->save();

        $user = Auth::user();
        $user->current_project_id = $project->id;
        $user->update();

        $tasks = Task::where('user_id', Auth::id())
            ->where('done', false)
            ->where('project_id', $project->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('task.index', [
            'tasks' => $tasks
        ]);
    }
}
