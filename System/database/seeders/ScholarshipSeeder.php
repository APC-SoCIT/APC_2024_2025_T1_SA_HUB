<?php

namespace Database\Seeders;

use App\Models\SaProfile;
use App\Models\Scholarship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SaScholars = SaProfile::all();
        foreach ($SaScholars as $scholar) {
            Scholarship::create([
                'stud_id' => $scholar->user_id,
                'scholarship_status' => 'active',
            ]);
        }
    }
}
