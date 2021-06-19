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

    /** @test */
    public function view_talk_submissions()
    {
        $response = $this->get('/talks/my');
        $response->assertStatus(302);

        $this->signIn();
        $response = $this->get('/talks/my');
        $response->assertStatus(200);
    }

    /** @test */
    public function create_talk_submission()
    {
        Livewire::test(Submission::class)
            ->call('submit')
            ->assertForbidden();

        $this->signIn();

        Livewire::test(Submission::class)
            ->set('talk.wishtime', '1x.2.2020')
            ->call('submit')
            ->assertHasErrors('talk.wishtime');

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
    }
}
