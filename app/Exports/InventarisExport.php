<?php

namespace App\Exports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\AnggotaKelompok;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class InventarisExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function headings(): array
    {
        // Return an array of column names from your template file
        return ['Tanggal Pembukuan', 'Kode', 'Nama', 'Jumlah', 'Harga Satuan', 'Harga Total', 'Kondisi', 'Deskripsi'];
    }
    public function title(): string
    {
        // Return the title of the sheet
        return 'Data Inventaris Anggota Kelompok';
    }
    public function collection()
    {
        $inventaris = Inventaris::all();

        return $inventaris->map(function ($item) {
            return [
                'Tanggal Pembukuan' => $item->tgl_pembukuan,
                'Kode' => $item->kode,
                'Nama' => $item->nama,
                'Jumlah' => $item->jumlah,
                'Harga Satuan' => $item->harga_satuan,
                'Harga Total' => $item->harga_total,
                'Kondisi' => $item->kondisi == 1 ? 'Baik' : 'Rusak',
                'Deskripsi' => $item->deskripsi_barang
            ];
        });
    }
}
