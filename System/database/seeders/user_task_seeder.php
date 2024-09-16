<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user_task_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('user_tasks')->insert([
            ['user_id' => 14,
            'task_id' => 3,
            'task_status_id' => 1,
            ],
            ['user_id' => 14,
            'task_id' => 7,
            'task_status_id' => 1,
            ],
            ['user_id' => 14,
            'task_id' => 8,
            'task_status_id' => 1,
            ],
            ['user_id' => 14,
            'task_id' => 9,
            'task_status_id' => 1,
            ],
            ['user_id' => 14,
            'task_id' => 10,
            'task_status_id' => 1,
            ],
            ['user_id' => 14,
            'task_id' => 11,
            'task_status_id' => 1,
            ],
            ['user_id' => 14,
            'task_id' => 12,
            'task_status_id' => 1,
            ],
            ['user_id' => 14,
            'task_id' => 13,
            'task_status_id' => 1,
            ],
            ['user_id' => 14,
            'task_id' => 14,
            'task_status_id' => 1,
            ],
        ]);
    }
}
