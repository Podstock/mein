<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function room_exists()
    {
        $this->signIn();
        Room::factory(['slug' => 'test'])->create();
        $response = $this->get('/room/test');

        $response->assertStatus(200);
    }

    /** @test */
    public function echo_room_users()
    {
        $user = $this->signIn();
        $room = Room::factory(['slug' => 'test'])->create();
        $room->users()->attach($user->id, ['role' => Room::SPEAKER]);

        $response = $this->post(
            '/broadcasting/auth',
            ['channel_name' => 'presence-users.' . $room->id]
        );
        $response->assertSee('\"id\":1', false);
        $response->assertSee('\"type\":\"speaker\"', false);
        $response->assertStatus(200);
    }

    /** @test */
    public function echo_room_chat()
    {
        $this->signIn();
        $room = Room::factory(['slug' => 'test'])->create();
        $response = $this->post(
            '/broadcasting/auth',
            ['channel_name' => 'private-chat.' . $room->id]
        );
        $response->assertStatus(200);
    }
}
