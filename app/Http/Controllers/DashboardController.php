<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $totalProjects = Project::where('user_id', $user->id)->count();

        $tasksCompletedToday = Task::whereHas('project', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('status', 'done')
        ->whereDate('updated_at', now()->toDateString())
        ->count();

        return Inertia::render('Dashboard', [
            'totalProjects' => $totalProjects,
            'tasksCompletedToday' => $tasksCompletedToday,
        ]);
    }
}
