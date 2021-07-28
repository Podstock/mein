<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::truncate();
        $days = [
            'day2', 'day3'
        ];

        $hours = [
            '09:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00'
        ];

        foreach ($days as $day) {
            foreach ($hours as $hour) {
                Schedule::factory(
                    [
                        'time' => $hour . ':00',
                        'day' => $day,
                    ]
                )->create();
            }
        }
    }
}
