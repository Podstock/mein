<?php

namespace Database\Factories;

use App\Models\ConnectedAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ConnectedAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConnectedAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provider' => 'github',
            'provider_id' => 'github',
            'token' => Str::random(10),
        ];
    }
}
