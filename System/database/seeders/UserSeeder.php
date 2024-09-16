<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'id_number' => 110,
                'username' => 'registrar',
                'faculty' => 'Registrar',
                'account_type' => 'office_admin',
                'email' => 'registrar@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 111,
                'username' => 'jomercado',
                'faculty' => 'Student',
                'account_type' => 'student_assistant',
                'email' => 'jomercado99@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 112,
                'username' => 'pgomez',
                'faculty' => 'SA Manager',
                'account_type' => 'sa_manager',
                'email' => 'pgomez@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 113,
                'username' => 'accounting',
                'faculty' => 'Accounting',
                'account_type' => 'office_admin',
                'email' => 'accountancy@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 114,
                'username' => 'infotech',
                'faculty' => 'Information Technology',
                'account_type' => 'office_admin',
                'email' => 'itro@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 115,
                'username' => 'alexreyes',
                'faculty' => 'Student',
                'account_type' => 'student_assistant',
                'email' => 'alexreyes@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 116,
                'username' => 'emvill',
                'faculty' => 'Student',
                'account_type' => 'student_assistant',
                'email' => 'emvill12@email.com',
                'password' => bcrypt('password'),
            ],
        ]);

    }
}
