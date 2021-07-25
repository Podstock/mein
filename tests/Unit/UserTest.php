<?php

namespace Tests\Unit;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_has_room_type()
    {
        $user = User::factory()->create();
        $room = Room::factory(['slug' => 'test'])->create();
        $room->users()->attach($user->id, ['role' => Room::SPEAKER]);
        $this->assertDatabaseHas('room_user', [
            'user_id' => $user->id,
            'role' => Room::SPEAKER
        ]);
        $user2 = User::factory()->create();
        $room2 = Room::factory(['slug' => 'test2'])->create();

        $this->assertTrue($user->is_speaker($room->id));
        $this->assertFalse($user2->is_speaker($room->id));
        $this->assertFalse($user2->is_speaker($room2->id));
    }
}
