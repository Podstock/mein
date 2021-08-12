<?php

namespace Tests\Feature;

use App\Events\WebrtcSDP;
use App\Events\WebrtcTalk;
use App\Models\Baresip;
use App\Models\BaresipWebrtc;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
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

        Cache::put("online-$room->slug-" . $user->id, true);

        $response = $this->post(
            '/broadcasting/auth',
            ['channel_name' => 'presence-users.' . $room->slug]
        );
        $response->assertSee('\"id\":1', false);
        $response->assertSee('\"type\":\"speaker\"', false);
        $response->assertSee('\"connected\":true', false);
        $response->assertStatus(200);

        $this->post(
            '/broadcasting/auth',
            ['channel_name' => 'presence-users.unused']
        )->assertStatus(404);
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
        Cache::put("online-$room->slug-" . $user->id, true);

        //Laravel Echo Auth
        $this->post(
            '/broadcasting/auth',
            ['channel_name' => 'private-webrtc.sdp.' . $user->id]
        )->assertStatus(200);

        $user->room_speaker($room);

        //WebRTC Connect - SDP offer
        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"webrtc_sdp","params":"' . $user->id
                . ',false,audio,{\"sdp\":\"test\"}","token":"' . $user->id . '"}'
        );
        $this->json('post', '/webrtc/' . $room->slug . '/sdp', ['sdp' => 'test'])
            ->assertStatus(200);

        $this->assertDatabaseHas('baresips', ['users_count' => 1]);

        //WebRTC - Disconnect
        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"webrtc_disconnect","params":"' . $user->id
                . '_audio","token":"' . $user->id . '"}'
        );

        $room->user_offline();
        $this->get('/webrtc/' . $room->slug . '/disconnect')
            ->assertStatus(200);

        $response = $this->post(
            '/broadcasting/auth',
            ['channel_name' => 'presence-users.' . $room->slug]
        );
        $response->assertSee('\"connected\":false', false);
        $response->assertStatus(200);

        $this->assertDatabaseHas('baresips', ['users_count' => 0]);
    }

    /** @test */
    public function webrtc_room_test_echo()
    {
        $user = $this->signIn();

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/echo/command/",
            '{"command":"webrtc_sdp","params":"' . $user->id
                . ',true,audio,{\"sdp\":\"test\"}","token":"' . $user->id . '"}'
        );
        $this->json('post', '/webrtc/echo/sdp', ['sdp' => 'test'])
            ->assertStatus(200);

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/echo/command/",
            '{"command":"webrtc_disconnect","params":"' . $user->id
                . '_audio","token":"' . $user->id . '"}'
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

    /** @test */
    public function webrtc_room_test_speaker_audio()
    {
        $user = $this->signIn();
        $room = Room::factory(['slug' => 'test'])->create();
        $baresip = Baresip::factory(['room_id' => $room->id, 'id' => 22])->create();

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"aumix_mute","params":"'
                . $user->id . '_audio,true","token":"' . $user->id . '"}'
        );
        BaresipWebrtc::update_audio($room->id, $user);

        $user->room_speaker($room);

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"aumix_mute","params":"'
                . $user->id . '_audio,false","token":"' . $user->id . '"}'
        );
        BaresipWebrtc::update_audio($room->id, $user);

        $user->room_listener($room);

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"aumix_mute","params":"'
                . $user->id . '_audio,true","token":"' . $user->id . '"}'
        );
        BaresipWebrtc::update_audio($room->id, $user);
    }

    /** @test */
    public function webrtc_room_baresip_id()
    {

        $room1 = Room::factory(['slug' => 'test1'])->create();
        $room2 = Room::factory(['slug' => 'test2'])->create();
        $room3 = Room::factory(['slug' => 'test3'])->create();
        $baresip1 = Baresip::factory()->create();
        $baresip2 = Baresip::factory(['room_id' => $room2->id])->create();

        $id = BaresipWebrtc::room_baresip_id($room1->slug, 'inc');
        $this->assertEquals($baresip1->id, $id);

        $this->assertDatabaseHas('baresips', ['room_id' => $room1->id]);

        $id = BaresipWebrtc::room_baresip_id($room2->slug, 'inc');
        $this->assertEquals($baresip2->id, $id);

        $this->expectException('Illuminate\Database\Eloquent\ModelNotFoundException');
        BaresipWebrtc::room_baresip_id($room3->slug, 'inc');
        BaresipWebrtc::room_baresip_id('test33', 'inc');
    }

    /** @test */
    public function webrtc_mqtt_event()
    {
        $user = User::factory()->create();
        $room = Room::factory(['slug' => 'test'])->create();
        $baresip = Baresip::factory(['room_id' => $room->id])->create();
        $topic = "/baresip/$baresip->id/event";

        Event::fake();

        //SDP Answer
        $message = '{"type":"MODULE","class":"other","param":"webrtc,sdp,' . $user->id . '_audio,audio,{\"type\":\"answer\"}"}';
        BaresipWebrtc::mqtt_event($topic, $message);

        Event::assertDispatched(function (WebrtcSDP $event) use ($user) {
            return (string)$event->broadcastOn() === "private-webrtc.sdp." . $user->id &&
                $event->sdp->type === 'answer';
        });

        //aumix Talk
        $message = '{"type":"MODULE","class":"other","param":"aumix,talk,11_audio"}';
        BaresipWebrtc::mqtt_event($topic, $message);

        Event::assertDispatched(function (WebrtcTalk $event) use ($room) {
            return (string)$event->broadcastOn() === "presence-users." . $room->slug;
        });
    }

    /** @test */
    public function webrtc_cam_video_sdp()
    {
        $user = $this->signIn();
        $room = Room::factory(['slug' => 'test'])->create();
        $baresip = Baresip::factory()->create();

        $this->json('post', '/webrtc_video/test/sdp', ['sdp' => 'test'])
            ->assertStatus(404);

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"webrtc_sdp","params":"' . $user->id
                . ',true,video,{\"sdp\":\"test\"}","token":"' . $user->id . '"}'
        );
        $this->json('post', '/webrtc_video/test/sdp/cam', ['sdp' => 'test'])
            ->assertStatus(200);

        $room->set_video_available(true);

        MQTT::shouldReceive('publish')->once()->with(
            "/baresip/$baresip->id/command/",
            '{"command":"webrtc_sdp","params":"' . $user->id
                . ',true,video,{\"sdp\":\"test\"}","token":"' . $user->id . '"}'
        );
        $this->json('post', '/webrtc_video/test/sdp', ['sdp' => 'test'])
            ->assertStatus(200);
    }
}
