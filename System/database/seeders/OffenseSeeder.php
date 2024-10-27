<?php

namespace Database\Seeders;

use App\Models\SaProfile;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offense; // Assuming you have an Offense model
use App\Models\StudentGrade;
use Illuminate\Support\Facades\DB;
use Log;

class OffenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offenses = [
            [
                'user_id' => 119, // Peter Parker
                'type' => 'major',
                'description' => 'Bullying',
                'status' => 'probation',
                'date_start' => Carbon::now(),
                'date_end' => Carbon::now()->startOfWeek()->addDays(rand(1, 5)),
            ],
            [
                'user_id' => 120, // Bruce Lane
                'type' => 'major',
                'description' => 'Cheating',
                'status' => 'probation',
                'date_start' => Carbon::now(),
                'date_end' => Carbon::now()->startOfWeek()->addDays(rand(1, 5)),
            ],
            [
                'user_id' => 121, // Clark Kent
                'type' => 'major',
                'description' => 'Harassment',
                'status' => 'probation',
                'date_start' => Carbon::now()->startOfWeek(),
                'date_end' => Carbon::now()->startOfWeek()->addDays(rand(1, 5)),
            ],
            [
                'user_id' => 122, // Diana Prince
                'type' => 'major',
                'description' => 'Disrespect',
                'status' => 'pending_revoke',
                'date_start' => Carbon::now()->startOfWeek(),
                'date_end' => Carbon::now()->startOfWeek()->addDays(rand(1, 5)),
            ],
            [
                'user_id' => 123, // Barry Allen
                'type' => 'major',
                'description' => 'Theft',
                'status' => 'pending_revoke',
                'date_start' => null,
                'date_end' => null,
            ],
        ];

        DB::table('offenses')->insert($offenses);

        for ($userId = 119; $userId <= 121; $userId++) {
            $profile = SaProfile::where('user_id', $userId)->first();

            if ($profile) {
                $profile->update(['status' => 'probation']);
            }
        }

        for ($userId = 122; $userId <= 123; $userId++) {
            $profile = SaProfile::where('user_id', $userId)->first();

            if ($profile) {
                $profile->update(['status' => 'pending_revoke']);
            }
        }
    }
}
