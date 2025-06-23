<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    use AuthorizesRequests;
    
    public function store(StoreTaskRequest $request, Project $project)
    {
        $this->authorize('view', $project);

        $project->tasks()->create($request->validated());

        return redirect()->back()->with('success', 'Task created.');
    }

    public function update(StoreTaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('view', $project);
        $this->ensureTaskBelongsToProject($task, $project);

        $task->update($request->validated());

        return redirect()->back()->with('success', 'Task updated.');
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('view', $project);
        $this->ensureTaskBelongsToProject($task, $project);

        $task->delete();

        return redirect()->back()->with('success', 'Task deleted.');
    }

    /**
     * Ensure the task belongs to the project.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function ensureTaskBelongsToProject(Task $task, Project $project)
    {
        if ($task->project_id !== $project->id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
