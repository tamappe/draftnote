<?php

namespace App\Http\Controllers;

use App\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check())
        {
            $user_requests = UserRequest::where('done', false)
                ->where('admin_cancel', false)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return view('user_request.index', [
                'user_requests' => $user_requests,
                'user_id' => Auth::id()
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
        $task = new UserRequest;
        $task->user_id = Auth::id();
        $task->name = $request->name;
        $task->text = $request->text;
        $task->save();

        return redirect('/user_request');
    }

    public function destroy(Request $request, UserRequest $user_request)
    {
        $user_request->delete();
        return redirect('/user_request');
    }
}
