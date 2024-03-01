<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'nama' => 'bunga',
            'value' => '0.3'
        ]);
        DB::table('settings')->insert([
            'nama' => 'max pinjaman',
            'value' => '12 juta'
        ]);
    }
}
