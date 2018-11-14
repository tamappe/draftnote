<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //
    public function index(Request $request)
    {
        if (Auth::check())
        {
            $tasks = Task::where('user_id', Auth::id())
                ->where('done', false)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return view('task.index', [
                'tasks' => $tasks
            ]);
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
        $task = new Task;
        $task->user_id = Auth::id();
        $task->name = $request->name;
        $task->text = $request->text;
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
}
