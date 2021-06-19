<?php

namespace Tests\Feature;

use App\Http\Livewire\Mytalks;
use App\Http\Livewire\Submission;
use App\Models\Talk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TalkTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_submissions()
    {
        $response = $this->get('/talks/my');
        $response->assertStatus(302);

        $this->signIn();
        $response = $this->get('/talks/my');
        $response->assertStatus(200);
    }

    public function test_create_edit_delete_submission()
    {
        //Failed - no login
        Livewire::test(Submission::class)
            ->call('submit')
            ->assertForbidden();

        //Success - create
        $this->signIn();

        Livewire::test(Submission::class)
            ->set('talk.name', 'test')
            ->set('talk.type', Talk::TYPE_LIVESTREAM)
            ->set('talk.wishtime', Talk::WISHTIME_DAY2_1)
            ->set('talk.record', true)
            ->set('talk.description', 'Lorem ipsum 1234 Lorem Ipsum')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect(route('mytalks'));

        $this->assertDatabaseHas('talks', ['name' => 'test']);

        $talk = Talk::first();

        //Success - edit
        Livewire::test(Submission::class, [$talk])
            ->set('talk.name', 'test2')
            ->call('submit')
            ->assertRedirect(route('mytalks'));
        $this->assertDatabaseHas('talks', ['name' => 'test2']);

        //Failed - delete (not allowed)
        $other_talk = Talk::factory(['name' => 'secret_talk'])->create();
        Livewire::test(Submission::class, [$other_talk])
            ->call('delete')
            ->assertForbidden();
        $this->assertDatabaseHas('talks', ['name' => 'secret_talk']);

        //Success - delete
        Livewire::test(Submission::class, [$talk])
            ->call('delete')
            ->assertRedirect(route('mytalks'));
        $this->assertDatabaseMissing('talks', ['name' => 'test2']);

        //Failed - validation
        Livewire::test(Submission::class)
            ->set('talk.wishtime', '1x.2.2020')
            ->call('submit')
            ->assertHasErrors('talk.wishtime');


    }

}
