<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MultipleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i<=50; $i++){
            User::create([
                'name'=>'Staff'.$i,
                'email'=>'staff'.$i.'@aforeco.com',
                'role_id'=> 5,
                'department_id'=> null,
                'password'=>bcrypt('11111111'),
            ]);
        }
    }
}
