<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            [
                'name'=> 'User',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'Department',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'LeaveType',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'HolidayMode',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'Holiday',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'Leave',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'Calendar',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'UserLeaveBalance',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'LeaveEntitlement',
                'guard_name'=> 'web'
            ],
            [
                'name'=>'Permission',
                'guard_name'=> 'web'
            ]
            
            ];
            Permission::insert($permission);
            $superadmin = Role::where('name','SuperAdmin')->first();
            $superadmin->givePermissionTo([
                'User',
                'Department',
                'LeaveType',
                'HolidayMode',
                'Holiday',
                'Leave',
                'Calendar',
                'UserLeaveBalance',
                'LeaveEntitlement',
                'Permission'
            ]);
    }
}
