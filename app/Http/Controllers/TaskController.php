<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->current_project_id == null) {
                // まだプロジェクトを持っていないユーザーの対応
                $tasks = Task::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
                return view('task.index', [
                    'tasks' => $tasks,
                    'current_project_id' => null
                ]);
            } else {
                // プロジェクトマイグレーション済みのユーザー
                $projects = $user->projects;
                $project = $projects->where('id', $user->current_project_id)->first();
                $tasks = $project->tasks()
                    ->where('done', false)
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
                return view('task.index', [
                    'tasks' => $tasks,
                    'projects' => $projects,
                    'current_project_id' => $user->current_project_id
                ]);
            }
        } else {
            return redirect('/home');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        // タスク作成
        $user = Auth::user();
        $task = new Task;
        $task->user_id = $user->id;
        $task->name = $request->name;
        $task->text = $request->text;
        $task->project_id = $user->current_project_id;
        $task->save();

        return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }

    public function edit(Request $request, Task $task)
    {
        return view('task.edit', [
            'task' => $task
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        $task = Task::find($request->id);
        $task->name = $request->name;
        $task->text = $request->text;
        $task->update();

        return redirect('/tasks');
    }

    public function done(Request $request, Task $task)
    {
        $task->done = true;
        $task->update();
        return redirect('/tasks');
    }

    public function change(Request $request, Project $project)
    {
        // プロジェクトIdの更新
        $user = Auth::user();
        $projects = $user->projects;
        $user->current_project_id = $project->id;
        $user->update();

        return redirect('/tasks');
    }
}
