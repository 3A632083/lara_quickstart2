<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//    public function index(Request $request)
//    {
//        return view('tasks.index');
//    }
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();
//        $tasks= auth()->user()->tasks;
//        $tasks= auth()->user()->tasks()->get();
//        $tasks=Auth::user()->tasks;
//        $tasks=Auth::user()->tasks()->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }
    public function destroy(Request $request, Task $task)
    {
//      $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }
}
