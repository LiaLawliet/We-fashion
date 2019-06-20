<?php

use Illuminate\Database\Seeder;
use app\User;

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
            'name' => 'admin',
            'email' => 'admin@admin.fr',
            'password' => Hash::make('admin')
        ]);
    }
}
