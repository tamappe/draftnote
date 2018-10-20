<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;

class UserController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
    //
    public function index(Request $request)
    {
        if (Auth::check())
        {
            $tasks = Task::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
            return view('user.index', [
                'tasks' => $tasks
            ]);
        } else {
            return redirect('/login');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        if (Auth::check()) {
            // タスク作成
            $task = new Task;
            $task->user_id = Auth::id();
            $task->name = $request->name;
            $task->text = $request->text;
            $task->save();
        }

        return redirect('/');
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return redirect('/');
    }

    public function edit(Request $request, Task $task)
    {
        return view('user.edit', [
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

        return redirect('/');
    }
}
