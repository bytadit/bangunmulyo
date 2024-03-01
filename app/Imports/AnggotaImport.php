<?php

namespace App\Imports;

use App\Models\AnggotaKelompok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Carbon\Carbon;

class AnggotaImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $kelompok;

    public function __construct($kelompok)
    {
        $this->kelompok = $kelompok;
    }
    public function model(array $row)
    {
        return new AnggotaKelompok([
            'kelompok_id' => $this->kelompok,
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'jabatan_id' => $row['jabatan'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'noHP' => $row['nomor_hp'],
            'alamat' => $row['alamat'],
            'tgl_lahir' => isset($row['usia']) ? Carbon::now()->subYears($row['usia']) : null,
            'pekerjaan' => $row['pekerjaan']
        ]);
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "\t" // Set the delimiter to tab
        ];
    }
}
