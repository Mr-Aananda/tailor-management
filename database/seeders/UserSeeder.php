<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'name' => 'MaxSOP',
            'email' => 'admin@maxsop.com',
            'password' => Hash::make('password'),
        ]);

        // random 
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@maxsop.com',
            'password' => Hash::make('password'),
        ]);

        // command 
        // php artisan db:seed --class=UserSeeder
    }
}
