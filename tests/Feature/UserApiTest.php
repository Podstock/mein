<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_uuid()
    {
        $uuid = 'c8ae8c4e-dbd9-4858-a49d-26c8a2fc7e3b';

        $this->get('/api/uuid/' . $uuid)
            ->assertStatus(404);

        $user = User::factory(['uuid' => $uuid, 'nickname' => 'test'])->create();

        $this->get('/api/user/uuid/' . $uuid)
            ->assertStatus(200)
            ->assertExactJson(['username' => 'test', 'uuid' => $uuid]);
    }

    public function test_api_card_url()
    {
        $uuid = 'c8ae8c4e-dbd9-4858-a49d-26c8a2fc7e3b';
        $user = User::factory(['uuid' => $uuid, 'nickname' => 'test'])->create();
        $this->get('/api/user/card_url/' . $uuid)
            ->assertStatus(200)
            ->assertSee($user->id);
    }
}
