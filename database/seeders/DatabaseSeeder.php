<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       DB::table('users')->insert([
            'name' => 'User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
    }
}
