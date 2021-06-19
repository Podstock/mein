<?php

namespace Database\Factories;

use App\Models\Talk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TalkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Talk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'user_id' => User::factory()->create()->id,
            'wishtime' => Talk::WISHTIME_DAY2_1,
            'type' => Talk::TYPE_LIVESTREAM
        ];
    }
}
