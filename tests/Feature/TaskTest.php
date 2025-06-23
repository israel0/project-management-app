<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task_under_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('tasks.store', $project->id), [
            'title' => 'Fix Bug',
            'status' => 'pending',
            'due_date' => now()->addDays(5)->toDateString(),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', [
            'title' => 'Fix Bug',
            'project_id' => $project->id,
        ]);
    }

    public function test_user_can_view_tasks_of_a_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this->actingAs($user)->get(route('projects.show', $project->id));

        $response->assertStatus(200);
        $response->assertSee($task->title);
    }

    public function test_user_can_update_a_task()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this->actingAs($user)->put(route('tasks.update', [$project->id, $task->id]), [
            'title' => 'Updated Task',
            'status' => 'done',
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', [
            'title' => 'Updated Task',
            'status' => 'done',
            'project_id' => $project->id,
        ]);
    }

    public function test_user_can_delete_a_task()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this->actingAs($user)->delete(route('tasks.destroy', [$project->id, $task->id]));

        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
