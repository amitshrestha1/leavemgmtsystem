<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leavetypes = [
            [
                'name' => 'Sick Leave',
                'days' => '5'
            ],
            [
                'name' => 'Casual Leave',
                'days' => '5'
            ],
        ];
        LeaveType::insert($leavetypes);
    }
}
