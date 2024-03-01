<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;
use Alert;

class PeminjamKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelompoks = Peminjam::where('jenis_peminjam', 1)->get();
        return view('dashboard.admin.peminjam-kelompok.index', [
            'title' => 'Peminjam Kelompok',
            'kelompoks' => $kelompoks
        ]);
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
        $data = Peminjam::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noHP' => $request->no_hp,
            'nama_dusun' => $request->nama_dusun,
            'jenis_peminjam' => 1
        ]);
        Alert::success('Sukses!', 'Data Peminjam Kelompok berhasil ditambahkan!');
        return redirect()->route('peminjam-kelompok.index');
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
        $peminjam_id = $request->peminjam_id;
        Peminjam::where('id', $peminjam_id)
            ->update([
                'nama' => $request->enama,
                'alamat' => $request->ealamat,
                'noHP' => $request->eno_hp,
                'nama_dusun' => $request->enama_dusun,
                'jenis_peminjam' => $request->ejenis_peminjam
            ]);
        Alert::success('Sukses!', 'Data peminjam kelompok berhasil diubah!');
        return redirect()->route('peminjam-kelompok.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $peminjam_id = $request->peminjam_id;
        Peminjam::destroy($peminjam_id);
        Alert::success('Sukses!', 'Data peminjam kelompok berhasil dihapus!');
        return redirect()->route('peminjam-kelompok.index');
    }
}
