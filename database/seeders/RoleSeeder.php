<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
{
    $roles = [
        [
            'role_name' => 'admin',
            'description' => 'System Administrator'
        ],
        [
            'role_name' => 'instructor', 
            'description' => 'Course Instructor'
        ],
        [
            'role_name' => 'learner',
            'description' => 'Enrolled Student'
        ],
    ];
    
    foreach ($roles as $role) {
        Role::firstOrCreate(
            ['role_name' => $role['role_name']],
            $role
        );
    }
}
}
