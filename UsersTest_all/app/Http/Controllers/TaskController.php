<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Auth::user()->tasks()->orderBy('status')->get();
        return view('tasks.index', compact('tasks')); // تأكد من تمرير $tasks
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Auth::user()->tasks()->create(['name' => $request->name, 'status' => 0]);
        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    public function complete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized action.');
        }
        $task->update(['status' => 1]);
        return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }
}