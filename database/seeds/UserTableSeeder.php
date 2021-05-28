<?php

use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
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
            'name' => 'admin',
            'email' => 'edouard@admin.fr',
            'password' => Hash::make('admin'), // crypté le mot de passe ,
            ]
            ]);
    }
}
