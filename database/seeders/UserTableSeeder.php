<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Eko Budiyanto',
            'email' => 'eko@gmail.com',
            'password' => Hash::make('eko123')
        ]);
        DB::table('users')->insert([
            'name' => 'Suparni',
            'email' => 'suparni@gmail.com',
            'password' => Hash::make('suparni123')
        ]);
        DB::table('users')->insert([
            'name' => 'Ari',
            'email' => 'ari@gmail.com',
            'password' => Hash::make('ari123')
        ]);
        DB::table('users')->insert([
            'name' => 'Aditya',
            'email' => 'aditya@gmail.com',
            'password' => Hash::make('aditya123')
        ]);
        DB::table('users')->insert([
            'name' => 'Karno',
            'email' => 'karno@gmail.com',
            'password' => Hash::make('karno123')
        ]);
    }
}
