<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'avatar' => 'default.png',
            'name' => 'SMN',
            'email' => 'admin@admin.com',
            'password' => bcrypt('smn@1234'),
            'user_type' => 'superadmin',
        	'status' => 'active',
        ]);
    }
}