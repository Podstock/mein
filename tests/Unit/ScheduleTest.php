<?php

namespace Tests\Unit;

use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use App\Notifications\TalkAccepted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
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

    /** @test */
    public function notify_on_accepted()
    {
        Notification::fake();
        $talk = \App\Models\Talk::factory()->create();
        Notification::assertNothingSent();

        $talk->status = $talk::STATUS_ACCEPTED;
        $talk->save();
        Notification::assertSentTo(
            [$talk->user],
            TalkAccepted::class
        );

        Notification::fake();
        $talk->name = "test";
        $talk->save();
        Notification::assertNothingSent();
    }
}
