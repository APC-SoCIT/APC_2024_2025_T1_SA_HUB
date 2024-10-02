<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;

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
                // 'account_type' => 'office_admin',
                'email' => 'registrar@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 111,
                'username' => 'jomercado',
                'faculty' => 'Student',
                // 'account_type' => 'student_assistant',
                'email' => 'jomercado99@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 112,
                'username' => 'pgomez',
                'faculty' => 'SA Manager',
                // 'account_type' => 'sa_manager',
                'email' => 'pgomez@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 113,
                'username' => 'accounting',
                'faculty' => 'Accounting',
                // 'account_type' => 'office_admin',
                'email' => 'accountancy@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 117,
                'username' => 'guidance',
                'faculty' => 'Guidance Office',
                // 'account_type' => 'guidance_office',
                'email' => 'guidance@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 114,
                'username' => 'infotech',
                'faculty' => 'Information Technology',
                // 'account_type' => 'office_admin',
                'email' => 'itro@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 115,
                'username' => 'alexreyes',
                'faculty' => 'Student',
                // 'account_type' => 'student_assistant',
                'email' => 'alexreyes@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 116,
                'username' => 'emvill',
                'faculty' => 'Student',
                // 'account_type' => 'student_assistant',
                'email' => 'emvill12@email.com',
                'password' => bcrypt('password'),
            ],
        ]);

        //Assign Student Assistant Role

        $SARole = Role::where('name', 'student_assistant')->first();
        $SA = User::where('email', 'jomercado99@email.com')->first();
        $SA->assignRole($SARole);
        $SA = User::where('email', 'alexreyes@email.com')->first();
        $SA->assignRole($SARole);
        $SA = User::where('email', 'emvill12@email.com')->first();
        $SA->assignRole($SARole);

        // Assign Student Manager Role
        $samRole = Role::where('name', 'sa_manager')->first();
        $sam = User::where('email', 'pgomez@email.com')->first();
        $sam->assignRole($samRole);

        // Assign Office Admin A Role
        $oaRole = Role::where('name', 'office_admin')->first();
        $oa = User::where('email', 'registrar@email.com')->first();
        $oa->assignRole($oaRole);
        $oa = User::where('email', 'accountancy@email.com')->first();
        $oa->assignRole($oaRole);
        $oa = User::where('email', 'itro@email.com')->first();
        $oa->assignRole($oaRole);

        // Assign Guidance Admin Role
        $guidanceRole = Role::where('name', 'guidance_office')->first();
        $guidance = User::where('email', 'guidance@email.com')->first();
        $guidance->assignRole($guidanceRole);
    }
}
