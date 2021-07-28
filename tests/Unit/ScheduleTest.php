<?php

namespace Tests\Unit;

use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function talk_can_be_scheduled()
    {
        User::factory()->create();
        $room = Room::factory(['slug' => 'test'])->create();
        Schedule::factory(['room_id' => $room->id])->create();

        $this->assertDatabaseHas('schedules', ['room_id' => $room->id]);
    }
}
