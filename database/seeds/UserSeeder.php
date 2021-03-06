<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $const = '@gmail.com';
        $passw = '1234567890';

        // Create 10 users
        for ($i = 1; $i <= 10; $i++)
        {
            DB::table('users') -> insert(array(
                'name' => "User " . $i,
                'email' => "user" . $i . $const,
                'password' => bcrypt($passw),
                'is_admin' => 0,
            ));
        }

        // Create Admin
        DB::table('users') -> insert(array(
            'name' => "Admin ",
            'email' => "admin@gmail.com",
            'password' => bcrypt('1234567890'),
            'is_admin' => 1,
        ));

    }
}
