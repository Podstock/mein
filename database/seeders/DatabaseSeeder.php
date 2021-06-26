<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $user = User::factory()->make();
        $user->email = 'podstock@example.net';
        $user->password = Hash::make('1234');
        $user->save();
    }
}
