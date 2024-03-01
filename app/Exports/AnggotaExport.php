<?php

namespace App\Exports;

use App\Models\AnggotaKelompok;
use App\Models\Peminjam;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;


class AnggotaExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $kelompok;

    public function __construct($kelompok)
    {
        $this->kelompok = $kelompok;
    }
    public function headings(): array
    {
        // Return an array of column names from your template file
        return ['NIK', 'Nama', 'Jabatan', 'Jenis Kelamin', 'Nomor HP', 'Alamat', 'Usia', 'Pekerjaan'];
    }
    public function title(): string
    {
        // Return the title of the sheet
        $kelompok_name = Peminjam::where('id', $this->kelompok)->first()->nama;
        return 'Anggota Kelompok ' . $kelompok_name;
    }
    public function collection()
    {
        // return AnggotaKelompok::where('kelompok_id', $this->kelompok)->get();
        return AnggotaKelompok::with('kelompok', 'jabatan')->where('kelompok_id', $this->kelompok)->get()->map(function ($item) {
            return [
                'NIK' => $item->nik,
                'Nama' => $item->nama,
                'Jabatan' => optional($item->jabatan)->nama_jabatan,
                'Jenis Kelamin' => $item->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan',
                'Nomor HP' => $item->noHP,
                'Alamat' => $item->alamat,
                'Usia' => Carbon::parse($item->tgl_lahir)->diffInYears(Carbon::now()),
                'Pekerjaan' => $item->pekerjaan
            ];
        });
    }
}
