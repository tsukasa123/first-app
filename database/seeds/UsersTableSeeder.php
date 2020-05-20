<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++) {
            User::create([
                'screen_name' => 'user'.$i,
                'name' => 'USER'.$i,
                'email' => 'test'.$i.'@test.com',
                'password' => Hash::make('12345678'),
                'remember_token' => str_random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
