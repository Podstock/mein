<?php

namespace Tests\Feature;

use App\Facades\Image;
use App\Http\Livewire\Mytalks;
use App\Http\Livewire\Submission;
use App\Models\ConnectedAccount;
use App\Models\Talk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_nickname()
    {
        // User with direct nickname
        $user = User::factory(['nickname' => 'test'])->create();
        $this->assertTrue($user->nickname === 'test');

        // User with empty nickname but social account nickname
        $user = User::factory()->create();
        ConnectedAccount::factory([
            'user_id' => $user->id,
            'nickname' => 'test2'
        ])->create();
        $this->assertTrue($user->nickname === 'test2');
        $user->nickname = "test";
        $user->save();
        $this->assertTrue($user->fresh()->nickname === 'test');

        // User with empty nickname and empty social account nickname
        $user = User::factory()->create(['name' => 'My @_ \Username-']);
        ConnectedAccount::factory([
            'user_id' => $user->id,
        ])->create();
        $this->assertTrue($user->nickname === 'My_Username-');
    }
}
