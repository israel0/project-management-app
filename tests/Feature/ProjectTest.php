<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_project()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('projects.store'), [
            'title' => 'New Project',
            'description' => 'Test project',
            'deadline' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', ['title' => 'New Project', 'user_id' => $user->id]);
    }

    public function test_user_can_view_a_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('projects.show', $project->id));

        $response->assertStatus(200);
        $response->assertSee($project->title);
    }


public function test_user_can_update_a_project()
{
    $user = User::factory()->create();

    $project = Project::factory()->create([
        'user_id' => $user->id,
        'title' => 'Old Title',
        'description' => 'Old Description',
        'deadline' => now()->addDays(3),
    ]);

    $response = $this->actingAs($user)->put(route('projects.update', $project->id), [
        'title' => 'Updated Project',
        'description' => 'Updated Description',
        'deadline' => now()->addWeek()->toDateString(),
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => 'Updated Project',
    ]);
}


   public function test_user_can_delete_a_project()
{
    $user = User::factory()->create();
    $project = Project::factory()->create([
        'user_id' => $user->id,
    ]);
    $response = $this->actingAs($user)->delete(route('projects.destroy', $project->id));

    $response->assertRedirect();
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
}

}
