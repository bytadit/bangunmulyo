<?php

namespace App\Http\Controllers;

use App\Models\ReferensiJabatan;
use Illuminate\Http\Request;
use Alert;

class ReferensiJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = ReferensiJabatan::orderBy('id', 'ASC')->get();
        return view('dashboard.admin.jabatan.index', [
            'title' => 'Referensi Jabatan',
            'jabatans' => $jabatans
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
        $validatedData = $request->validate([
            'nama_jabatan' => 'required',
        ], [
            'required' => 'Nama Jabatan Wajib Diisi!',
        ]);

        $data = ReferensiJabatan::create($validatedData);
        Alert::success('Sukses!', 'Data referensi jabatan berhasil ditambahkan!');
        return redirect()->route('jabatan.index');
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
        $jabatan_id = $request->jabatan_id;
        $request->validate([
            'enama_jabatan' => 'required',
        ], [
            'required' => 'Nama Jabatan Wajib Diisi!',
        ]);
        ReferensiJabatan::where('id', $jabatan_id)
            ->update([
                'nama_jabatan' => $request->enama_jabatan
            ]);
        Alert::success('Sukses!', 'Data referensi jabatan berhasil diubah!');
        return redirect()->route('jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $jabatan_id = $request->jabatan_id;

        ReferensiJabatan::destroy($jabatan_id);
        Alert::success('Sukses!', 'Data referensi jabatan berhasil dihapus!');
        return redirect()->route('jabatan.index');
    }
}
