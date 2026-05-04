<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        public function index()
    {
        $tasks = Task::with('user')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }
    

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        auth()->user()->tasks()->create([
            'title' => $request->title,
            'status' => 'pending'
        ]);
        return redirect()->back()->with('success', 'tache ajouter avec success!!');
    }
    
    public function update(Task $task)
    {
        if($task->user_id != auth()->id()) {
            abort(403, 'cant change this tache');
        }
        $task->status = $task->status == 'pending' ? 'completed' : 'pending';
        $task->save();
        return redirect()->back()->with('success', 'update avec success!!');
    }
        public function edit(Task $task)
    {
        if($task->user_id != auth()->id()) {
            abort(403, 'cant change this tache');
        }
        return view('tasks.edit', compact('task'));
    }
    
    public function updateTitle(Request $request, Task $task)
    {
        if($task->user_id != auth()->id()) {
            abort(403, 'cant change this tache');
        }
        
        $request->validate(['title' => 'required|string|max:255']);
        $task->update(['title' => $request->title]);
        
        return redirect()->route('tasks.index')->with('success', 'tache update avec success!!');
    }
    
    public function destroy(Task $task)
    {
        if($task->user_id != auth()->id()) {
            abort(403, 'cant change this tache');
        }
        
        $task->delete();
        return redirect()->back()->with('success', 'tache supprimer avec success!!');
    }
}