<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGoalRequest;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Show the form for creating a new goal.
     * 
     * @return \Inertia\Response
     */
    public function create()
    {
        return inertia('Goal/Create');
    }

    /**
     * Store a newly created goal.
     * 
     * @param \App\Http\Requests\StoreGoalRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGoalRequest $request)
    {
        $deadline = $request->input('deadline');
        if ($deadline && strtotime($deadline) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->withErrors(['message' => 'The deadline must be today or a future date.']);
        }

        if ($deadline) {
            $status = (strtotime($deadline) > time()) ? 'active' : 'overdue';
            $request->merge(['status' => $status]);
        }

        Goal::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->route('index')->with('success', 'Goal created successfully.');
    }

    /**
     * Display the specified goal.
     * 
     * @param int $id
     * @return \Inertia\Response
     */
    public function show(int $id)
    {
        $goal = Goal::with('tasks')->findOrFail($id);

        return inertia('Goal/Show', [
            'goal' => $goal,
        ]);
    }

    /**
     * Display the form for editing the specified goal.
     * 
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit(int $id)
    {
        $goal = Goal::findOrFail($id);

        return inertia('Goal/Edit', [
            'goal' => $goal,
        ]);
    }

    /**
     * Update the specified goal.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:2',
            'description' => 'nullable|string|max:500',
            'deadline' => 'required|date',
        ]);

        $goal = Goal::findOrFail($id);

        if ($request->input('deadline') && strtotime($request->input('deadline')) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->withErrors(['message' => 'The deadline must be today or a future date.']);
        }
        if ($request->input('deadline')) {
            $status = (strtotime($request->input('deadline')) > time()) ? 'in_progress' : 'overdue';
            $request->merge(['status' => $status]);
        }

        $goal->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->route('index')->with('success', 'Goal updated successfully.');
    }

    public function updateStatus(int $id)
    {
        $goal = Goal::findOrFail($id);

        if ($goal->status === 'completed') {
            $goal->status = strtotime($goal->deadline) < time() ? 'overdue' : 'active';
        } else {
            $goal->status = 'completed';
        }

        $goal->save();
        
        return redirect()->route('index')->with('success', 'Status updated successfully');
    }

    /**
     * Remove the specified goal.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function destroy(int $id)
    {
        $goal = Goal::findOrFail($id);
        $goal->delete();

        return redirect()->route('index')->with('success', 'Goal deleted successfully.');
    }
}
