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
                'id_number' => 105,
                'username' => 'vcmagtangol',
                'faculty' => 'Electronics Engineering',
                // 'account_type' => 'office_admin',
                'email' => 'vcmagtangol@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 106,
                'username' => 'mataguan',
                'faculty' => 'Business Administration',
                // 'account_type' => 'office_admin',
                'email' => 'mataguan@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 107,
                'username' => 'mcpangutan',
                'faculty' => 'Computer Engineering',
                // 'account_type' => 'office_admin',
                'email' => 'mcpangutan@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 108,
                'username' => 'mdsoriano',
                'faculty' => 'Computer Science',
                // 'account_type' => 'office_admin',
                'email' => 'mdsoriano@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 109,
                'username' => 'guidance',
                'faculty' => 'Guidance Office',
                // 'account_type' => 'guidance_office',
                'email' => 'guidance@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 110,
                'username' => 'pgomez',
                'faculty' => 'SA Manager',
                // 'account_type' => 'sa_manager',
                'email' => 'pgomez@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 111,
                'username' => 'registrar',
                'faculty' => 'Registrar',
                // 'account_type' => 'office_admin',
                'email' => 'registrar@email.com',
                'password' => bcrypt('password'),
            ],

            [
                'id_number' => 112,
                'username' => 'accounting',
                'faculty' => 'Accounting',
                // 'account_type' => 'office_admin',
                'email' => 'accountancy@email.com',
                'password' => bcrypt('password'),
            ],

            [
                'id_number' => 113,
                'username' => 'infotech',
                'faculty' => 'Information Technology',
                // 'account_type' => 'office_admin',
                'email' => 'itro@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 114,
                'username' => 'jomercado',
                'faculty' => 'Student',
                // 'account_type' => 'student_assistant',
                'email' => 'jomercado99@email.com',
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
            [
                'id_number' => 117,
                'username' => 'johnsmith',
                'faculty' => 'Student',
                'email' => 'johnsmith@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 118,
                'username' => 'mariajones',
                'faculty' => 'Student',
                'email' => 'mariajones@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 119,
                'username' => 'peterparker',
                'faculty' => 'Student',
                'email' => 'peterparker@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 120,
                'username' => 'brucelane',
                'faculty' => 'Student',
                'email' => 'brucelane@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 121,
                'username' => 'clarkkent',
                'faculty' => 'Student',
                'email' => 'clarkkent@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 122,
                'username' => 'dianaprince',
                'faculty' => 'Student',
                'email' => 'dianaprince@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 123,
                'username' => 'barryallen',
                'faculty' => 'Student',
                'email' => 'barryallen@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 124,
                'username' => 'arthurcurry',
                'faculty' => 'Student',
                'email' => 'arthurcurry@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 125,
                'username' => 'victorstone',
                'faculty' => 'Student',
                'email' => 'victorstone@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 126,
                'username' => 'haljordan',
                'faculty' => 'Student',
                'email' => 'haljordan@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 127,
                'username' => 'kylewalker',
                'faculty' => 'Student',
                'email' => 'kylewalker@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 128,
                'username' => 'selinakyle',
                'faculty' => 'Student',
                'email' => 'selinakyle@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 129,
                'username' => 'loislane',
                'faculty' => 'Student',
                'email' => 'loislane@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 130,
                'username' => 'harleyquinn',
                'faculty' => 'Student',
                'email' => 'harleyquinn@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 131,
                'username' => 'dickgrayson',
                'faculty' => 'Student',
                'email' => 'dickgrayson@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 132,
                'username' => 'jasonwood',
                'faculty' => 'Student',
                'email' => 'jasonwood@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 133,
                'username' => 'timdrake',
                'faculty' => 'Student',
                'email' => 'timdrake@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'id_number' => 134,
                'username' => 'steverogers',
                'faculty' => 'Student',
                'email' => 'steverogers@email.com',
                'password' => bcrypt('password'),
            ]
        ]);

        //Assign Student Assistant Role

        $SARole = Role::where('name', 'student_assistant')->first();
        $saEmails = [
            'jomercado99@email.com',
            'alexreyes@email.com',
            'emvill12@email.com',
            'johnsmith@email.com',
            'mariajones@email.com',
            'peterparker@email.com',
            'brucelane@email.com',
            'clarkkent@email.com',
            'dianaprince@email.com',
            'barryallen@email.com',
            'arthurcurry@email.com',
            'victorstone@email.com',
            'haljordan@email.com',
            'kylewalker@email.com',
            'selinakyle@email.com',
            'loislane@email.com',
            'harleyquinn@email.com',
            'dickgrayson@email.com',
            'jasonwood@email.com',
            'timdrake@email.com',
            'steverogers@email.com',
        ];
        foreach ($saEmails as $email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->assignRole($SARole);
            }
        }

        // Assign Office Admin A Role
        $oaRole = Role::where('name', 'office_admin')->first();
        $officeEmails = [
            'accountancy@email.com',
            'itro@email.com',
            'registrar@email.com',
            'mdsoriano@email.com',
            'mcpangutan@email.com',
            'mataguan@email.com',
            'vcmagtangol@email.com',
        ];
        foreach ($officeEmails as $email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->assignRole($oaRole);
            }
        }

        // Assign Guidance Admin Role
        $guidanceRole = Role::where('name', 'guidance_office')->first();
        $guidance = User::where('email', 'guidance@email.com')->first();
        $guidance->assignRole($guidanceRole);

        // Assign Student Manager Role
        $samRole = Role::where('name', 'sa_manager')->first();
        $sam = User::where('email', 'pgomez@email.com')->first();
        $sam->assignRole($samRole);

    }
}
