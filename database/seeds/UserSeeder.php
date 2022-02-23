<?php

use App\Models\User;
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
        User::create([
            'name' =>'Ayoub Taknasi',
            'email' => 'taknasi.ayoub@gmail.com',
            'password' => bcrypt('123456789')
        ]);
    }
}
