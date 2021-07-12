<?php

namespace Tests\Feature;

use App\Http\Livewire\Camping\Project as CampingProject;
use App\Http\Livewire\Camping\Projects as CampingProjects;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CampingTest extends TestCase
{
    use RefreshDatabase;
    public function test_projects()
    {
        $user = $this->signIn();
        Livewire::test(CampingProjects::class)
            ->assertCount('projects', 0)
            ->call("new")
            ->assertCount('projects', 1);
    }

    public function test_project()
    {
        $user = $this->signIn();
        $project = Project::factory(['user_id' => $user->id])->create();
        Livewire::test(CampingProject::class, ['project' => $project])
            ->call('save');

        Livewire::test(CampingProject::class, ['project' => $project])
            ->call('delete');

        $this->assertDatabaseCount('projects', 0);
    }
}
