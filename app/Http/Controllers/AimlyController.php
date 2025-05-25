<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;

class AimlyController extends Controller
{
    /**
     * Display the main page with all goals and tasks.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $goals = Goal::with(['tasks' => function ($query) {
            $query->ordered();
        }])->ordered()->get();
    

        return inertia('Welcome', [
            'goals' => $goals,
        ]);
    }
}
