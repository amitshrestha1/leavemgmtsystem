<?php

namespace Database\Seeders;

use App\Models\HolidayMode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidayModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidaymode = [
            [
                'mode' => 'Sunday',
            ],
            [
                'mode' => 'Monday',
            ],
            [
                'mode' => 'Tuesday',
            ],
            [
                'mode' => 'Wednesday',
            ],
            [
                'mode' => 'Thursday',
            ],
            [
                'mode' => 'Friday',
            ],
            [
                'mode' => 'Saturday',
            ],
        ];
        HolidayMode::insert($holidaymode);
    }
}
