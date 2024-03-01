<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'ketua',
            'display_name' => 'Ketua'
        ]);
        DB::table('roles')->insert([
            'name' => 'bendahara',
            'display_name' => 'Bendahara'
        ]);
        DB::table('roles')->insert([
            'name' => 'sekretaris',
            'display_name' => 'Sekretaris'
        ]);
    }
}
