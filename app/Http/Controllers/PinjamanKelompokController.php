<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Alert;
use App\Models\AnggotaKelompok;
use App\Models\Angsuran;
use App\Models\Peminjam;
use App\Models\Pinjaman;
use App\Models\PinjamanAnggota;

class PinjamanKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $peminjam_id = $request->peminjam_id;
        $periode = Pinjaman::where('peminjam_id', $peminjam_id)->count();
        $data = new Pinjaman;
        $data->peminjam_id = $peminjam_id;
        $data->tgl_pinjaman = $request->tgl_pinjaman;
        $data->tgl_pencairan = $request->tgl_pencairan;
        $data->periode_pinjaman = $periode + 1;
        $data->jangka_waktu = 12;
        if($data->tgl_pencairan != null){
            $data->tgl_jatuh_tempo = Carbon::parse($request->tgl_pencairan)->addMonths(12);
        }
        $data->keperluan = $request->keperluan;
        $data->keterangan = 0;
        $data->save();
        Alert::success('Sukses!', 'Data Pinjaman Kelompok berhasil diatur!');
        return redirect()->route('detail-kelompok.index', ['kelompok' => $peminjam_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $kelompok = $request->route('kelompok');
        $pinjaman_kelompok = $request->route('pinjaman_kelompok');
        $anggotas = AnggotaKelompok::where('kelompok_id', $kelompok)->get();
        $pinjaman_anggotas = PinjamanAnggota::where('pinjaman_id', $pinjaman_kelompok)->get();
        return view('dashboard.admin.pinjaman-anggota.index', [
            'title' => 'Detail Pinjaman Periode ' . Pinjaman::where('id', $pinjaman_kelompok)->first()->periode_pinjaman,
            'anggotas' => $anggotas,
            'pinjaman_kelompok' => $pinjaman_kelompok,
            'pinjaman_anggotas' => $pinjaman_anggotas,
            'angsurans' => Angsuran::where('pinjaman_id', $pinjaman_kelompok)->get(),
            'kelompok' => $kelompok,
            'pinjaman' =>  Pinjaman::where('id', $pinjaman_kelompok)->get(),
            'periode' => Pinjaman::where('id', $pinjaman_kelompok)->first()->periode_pinjaman,
            'kelompok_name' => Peminjam::where('id', $kelompok)->first()->nama,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pinjaman_id = $request->pinjaman_id;
        $peminjam_id = $request->peminjam_id;
        $kelompok = $request->route('kelompok');

        Pinjaman::where('id', $pinjaman_id)
            ->update([
                'peminjam_id' => $peminjam_id,
                'tgl_pinjaman' => $request->etgl_pinjaman,
                'periode_pinjaman' => $request->eperiode,
                'jangka_waktu' => $request->ejangka_waktu,
                'tgl_pencairan' => $request->etgl_pencairan,
                'tgl_jatuh_tempo' => Carbon::parse($request->etgl_pencairan)->addMonths($request->ejangka_waktu),
                'keperluan' => $request->ekeperluan,
                'keterangan' => $request->eketerangan,
            ]);
        Alert::success('Sukses!', 'Data pinjaman kelompok berhasil diubah!');
        return redirect()->route('detail-kelompok.index', ['kelompok' => $peminjam_id]);
    }

    public function updateFull(Request $request, string $id)
    {
        $pinjaman_id = $request->pinjaman_id;
        $peminjam_id = $request->peminjam_id;
        $kelompok = $request->route('kelompok');
        Pinjaman::where('id', $pinjaman_id)
            ->update([
                'peminjam_id' => $peminjam_id,
                'tgl_pinjaman' => $request->etgl_pinjaman,
                'tgl_pencairan' => $request->etgl_pencairan,
                'tgl_pelunasan' => $request->etgl_pelunasan,
                'periode_pinjaman' => $request->eperiode,
                'jangka_waktu' => $request->ejangka_waktu,
                'tgl_jatuh_tempo' => Carbon::parse($request->etgl_pinjaman)->addMonths($request->ejangka_waktu),
                'keperluan' => $request->ekeperluan,
                'keterangan' => $request->eketerangan,
            ]);
        Alert::success('Sukses!', 'Detail pinjaman kelompok berhasil diubah!');
        return redirect()->route('pinjaman-kelompok.show', ['kelompok' => $peminjam_id, 'pinjaman_kelompok' => $pinjaman_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $pinjaman_id = $request->pinjaman_id;
        $peminjam_id = $request->peminjam_id;
        Pinjaman::destroy($pinjaman_id);
        Alert::success('Sukses!', 'Data pinjaman kelompok berhasil dihapus!');
        return redirect()->route('detail-kelompok.index', ['kelompok' => $peminjam_id]);
    }
}
