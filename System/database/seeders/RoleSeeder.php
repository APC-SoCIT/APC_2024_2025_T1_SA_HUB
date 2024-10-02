<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        // Create roles if they don't exist
        // if (!Role::where('name', 'office_admin')->exists()) {
        //     Role::create(['name' => 'admin', 'guard_name' => $guardname]);
        // }
        // if (!Role::where('name', 'sa_manager')->exists()) {
        //     Role::create(['name' => 'trainer', 'guard_name' => $guardname]);
        // }
        // if (!Role::where('name', 'student_assistant')->exists()) {
        //     Role::create(['name' => 'member', 'guard_name' => $guardname]);
        // }

        $roles = ['super_admin', 'student_assistant', 'sa_manager', 'office_admin', 'guidance_office'];
        $guardname = 'web';

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'guard_name' => $guardname,
            ]);
        }
    }
}
