<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Alert;

class PinjamanController extends Controller
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
        $data = Pinjaman::create([
            'peminjam_id' => $peminjam_id,
            'tgl_pinjaman' => $request->tgl_pinjaman,
            'periode_pinjaman' => $periode + 1,
            'jangka_waktu' => 12,
            'tgl_jatuh_tempo' => Carbon::parse($request->tgl_pinjaman)->addMonths(12),
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
        ]);
        Alert::success('Sukses!', 'Data Pinjaman Kelompok berhasil diatur!');
        return redirect()->route('detail-kelompok.index', ['kelompok' => $peminjam_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
                'tgl_jatuh_tempo' => Carbon::parse($request->etgl_pinjaman)->addMonths($request->ejangka_waktu),
                'keperluan' => $request->ekeperluan,
                'keterangan' => $request->eketerangan,
            ]);
        Alert::success('Sukses!', 'Data pinjaman kelompok berhasil diubah!');
        return redirect()->route('detail-kelompok.index', ['kelompok' => $peminjam_id]);
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
