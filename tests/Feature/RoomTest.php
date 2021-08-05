<?php

namespace Tests\Feature;

use App\Events\WebrtcSDP;
use App\Models\Baresip;
use App\Models\BaresipWebrtc;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use PhpMqtt\Client\Facades\MQTT;
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

    /** @test */
    public function webrtc_room_test()
    {
        $user = $this->signIn();
        $room = Room::factory(['slug' => 'test'])->create();
        $baresip = Baresip::factory(['room_id' => $room->id])->create();

        //Laravel Echo Auth
        $this->post(
            '/broadcasting/auth',
            ['channel_name' => 'private-webrtc.sdp.' . $user->id]
        )->assertStatus(200);

        //WebRTC Connect - SDP offer
        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"webrtc_sdp","params":"' . $user->id
                . ',{\"sdp\":\"test\"}","token":"' . $user->id . '"}'
        );
        $this->json('post', '/webrtc/' . $room->slug . '/sdp', ['sdp' => 'test'])
            ->assertStatus(200);

        $this->assertDatabaseHas('baresips', ['users_count' => 1]);

        //WebRTC - SDP answer
        Event::fake();
        BaresipWebrtc::sdp_answer('{"param": "webrtc,sdp,' . $user->id . ',{\"type\":\"answer\"}"}');
        Event::assertDispatched(function (WebrtcSDP $event) use ($user) {
            return (string)$event->broadcastOn() === "private-webrtc.sdp." . $user->id &&
                $event->sdp->type === 'answer';
        });

        //WebRTC - Disconnect
        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"webrtc_disconnect","params":"' . $user->id
                . '","token":"' . $user->id . '"}'
        );

        $this->get('/webrtc/' . $room->slug . '/disconnect')
            ->assertStatus(200);

        $this->assertDatabaseHas('baresips', ['users_count' => 0]);
    }

    /** @test */
    public function webrtc_room_test_echo()
    {
        $user = $this->signIn();

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/echo/command/",
            '{"command":"webrtc_sdp","params":"' . $user->id
                . ',{\"sdp\":\"test\"}","token":"' . $user->id . '"}'
        );
        $this->json('post', '/webrtc/echo/sdp', ['sdp' => 'test'])
            ->assertStatus(200);

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/echo/command/",
            '{"command":"webrtc_disconnect","params":"' . $user->id
                . '","token":"' . $user->id . '"}'
        );

        $this->get('/webrtc/echo/disconnect')
            ->assertStatus(200);
    }

    /** @test */
    public function webrtc_room_test_404()
    {
        $this->signIn();

        $this->json('post', '/webrtc/notexists/sdp', ['sdp' => 'test'])
            ->assertStatus(404);

        $this->get('/webrtc/notexists/disconnect')
            ->assertStatus(404);
    }
}
