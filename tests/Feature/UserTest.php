<?php

namespace Tests\Feature;

use App\Models\ConnectedAccount;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_nickname()
    {
        // User with direct nickname
        $user = User::factory(['nickname' => 'test'])->create();
        $this->assertEquals('test', $user->nickname);

        // User with empty nickname but social account nickname
        $user = User::factory()->create();
        ConnectedAccount::factory([
            'user_id' => $user->id,
            'nickname' => 'test2'
        ])->create();
        $this->assertEquals('test2', $user->nickname);
        $user->nickname = "test";
        $user->save();
        $this->assertEquals('test', $user->fresh()->nickname);

        // User with empty nickname and empty social account nickname
        $user = User::factory()->create(['name' => 'My @_ \Username-']);
        ConnectedAccount::factory([
            'user_id' => $user->id,
        ])->create();
        $this->assertEquals('My_Username-', $user->nickname);
    }

    public function test_uuid()
    {
        // Empty uuid
        Str::createUuidsUsing(function () {
            return '9b682c22-c549-4cf1-9de6-00ef2cd13868';
        });
        $user = User::factory()->create();
        $this->assertEquals('9b682c22-c549-4cf1-9de6-00ef2cd13868', $user->uuid);
        $this->assertDatabaseHas(
            'users',
            ['uuid' => '9b682c22-c549-4cf1-9de6-00ef2cd13868']
        );

        // Saved uuid (should not overriden)
        Str::createUuidsUsing(function () {
            return 'fd57749b-ecc0-4a17-a299-5183924a115b';
        });
        $this->assertEquals(
            '9b682c22-c549-4cf1-9de6-00ef2cd13868',
            $user->fresh()->uuid
        );
    }
}
