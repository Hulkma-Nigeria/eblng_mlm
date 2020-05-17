<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'firstname' => 'admin',
                'lastname' => 'admin',
                'username' => 'admin',
                'email' => 'admin@emosbest.com',
                'mobile' => '28375',
                'password' => Hash::make('admin'),
                'access_type' => 'admin',
                'address' => json_encode([
                    'address' => '',
                    'city' => '',
                    'state' => '',
                    'zip' => '',
                    'country' => '',
                ]),

            ],
            [
                'firstname' => 'user1',
                'lastname' => 'user1',
                'username' => 'user1',
                'email' => 'user1@emosbest.com',
                'mobile' => '28975',
                'password' => Hash::make('user1'),
                'access_type' => 'general',
                'address' => json_encode([
                    'address' => '',
                    'city' => '',
                    'state' => '',
                    'zip' => '',
                    'country' => '',
                ]),
            ],
            [
                'firstname' => 'user2',
                'lastname' => 'user2',
                'username' => 'user2',
                'email' => 'user2@emosbest.com',
                'mobile' => '28175',
                'password' => Hash::make('user2'),
                'access_type' => 'member',
                'address' => json_encode([
                    'address' => '',
                    'city' => '',
                    'state' => '',
                    'zip' => '',
                    'country' => '',
                ]),
            ]

        ]);
        // factory(App\User::class, 3)->create();
    }
}
