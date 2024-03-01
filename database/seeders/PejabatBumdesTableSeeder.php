<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PejabatBumdesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pejabat_bumdes')->insert([
            'user_id' => 1,
            'jabatan_id' => 1
        ]);
        DB::table('pejabat_bumdes')->insert([
            'user_id' => 2,
            'jabatan_id' => 2
        ]);
        DB::table('pejabat_bumdes')->insert([
            'user_id' => 3,
            'jabatan_id' => 3
        ]);
        DB::table('pejabat_bumdes')->insert([
            'user_id' => 4,
            'jabatan_id' => 4
        ]);
        DB::table('pejabat_bumdes')->insert([
            'user_id' => 5,
            'jabatan_id' => 5
        ]);
    }
}
