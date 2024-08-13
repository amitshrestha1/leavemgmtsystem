<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            [
                'name' => 'SuperAdmin',
                'guard_name' =>'web'
            ],
            [
                'mode' => 'Admin',
                'guard_name' =>'web'
            ],
            [
                'mode' => 'Head Representative',
                'guard_name' =>'web'
            ],
            [
                'mode' => 'Manager',
                'guard_name' =>'web'
            ],
            [
                'mode' => 'Staff',
                'guard_name' =>'web'
            ],
            
        ];
        ModelsRole::insert($role);
    }
}
