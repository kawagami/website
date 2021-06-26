<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => '11111111',
                'email' => '11111111@11111111',
                'password' => bcrypt(11111111),
                'created_at' => now()->toDateString(),
                'updated_at' => now()->toDateString(),
            ]
        ]);
    }
}
