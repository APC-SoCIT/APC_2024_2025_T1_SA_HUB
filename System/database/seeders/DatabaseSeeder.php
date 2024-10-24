<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SaProfileSeeder::class,
            CoursesSeeder::class,
            SubjectOfferingSeeder::class,
            SaScheduleSeeder::class,
            StudentGradeSeeder::class,
            OffenseItemSeeder::class,
            OffenseSeeder::class,
            ScholarshipSeeder::class,
            TaskSeeder::class,
            // UserTaskSeeder::class,
        ]);
    }
}

// php artisan migrate:refresh --seed --seeder=DatabaseSeeder
