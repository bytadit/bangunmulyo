<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ReferensiJabatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('referensi_jabatans')->insert([
            'nama_jabatan' => 'Ketua',
        ]);
        DB::table('referensi_jabatans')->insert([
            'nama_jabatan' => 'Bendahara',
        ]);
        DB::table('referensi_jabatans')->insert([
            'nama_jabatan' => 'Sekretaris',
        ]);
        DB::table('referensi_jabatans')->insert([
            'nama_jabatan' => 'Anggota',
        ]);
        DB::table('referensi_jabatans')->insert([
            'nama_jabatan' => 'Kepala Desa',
        ]);
    }
}
