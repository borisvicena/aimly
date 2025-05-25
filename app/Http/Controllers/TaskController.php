<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new task under a specific goal.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function create(int $id)
    {
        $goal = Goal::findOrFail($id);

        return inertia('Task/Create', [
            'goal' => $goal,
        ]);
    }

    /**
     * Store a newly created task under a specific goal.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:2',
            'description' => 'nullable|string|max:500',
            'due_date' => 'required|date',
        ]);

        $goal = Goal::findOrFail($id);

        if ($request->input('due_date') && strtotime($request->input('due_date')) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->withErrors(['message' => 'The due date must be today or a future date.']);
        }
        if ($request->input('due_date')) {
            $status = (strtotime($request->input('due_date')) > time()) ? 'in_progress' : 'overdue';
            $request->merge(['status' => $status]);
        }

        $task = new Task([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'status' => $request->input('status'),
        ]);

        $goal->tasks()->save($task);

        return redirect()->route('goal.show', ['id' => $id])->with('success', 'Task created successfully.');
    }

    /**
     * Toggle the status of a task.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(int $id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->status === 'completed') {
            $task->status = strtotime($task->due_date) < time() ? 'overdue' : 'in_progress';
        } else {
            $task->status = 'completed';
        }

        $task->save();

        return redirect()->back()->with('success', 'Task marked as successful.');
    }

    /**
     * Delete a task.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
