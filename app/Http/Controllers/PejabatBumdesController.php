<?php

namespace App\Http\Controllers;

use App\Models\PejabatBumdes;
use App\Models\ReferensiJabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;

class PejabatBumdesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pejabats = PejabatBumdes::orderBy('id', 'ASC')->get();
        return view('dashboard.admin.pejabat.index', [
            'title' => 'Daftar Pejabat BUMDes',
            'pejabats' => $pejabats,
            'staffs' => User::all(),
            'jabatans' => ReferensiJabatan::all()
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
            'user_id' => 'required',
            'jabatan_id' => 'required'
        ], [
            'user_id.required' => 'Nama Staff Wajib Diisi!',
            'jabatan_id.required' => 'Nama Jabatan Wajib Diisi!',
        ]);

        $data = PejabatBumdes::create($validatedData);
        Alert::success('Sukses!', 'Data pejabat BUMDes berhasil ditambahkan!');
        return redirect()->route('pejabat.index');
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
        $pejabat_id = $request->pejabat_id;
        PejabatBumdes::where('id', $pejabat_id)
            ->update([
                'user_id' => $request->euser_id,
                'jabatan_id' => $request->ejabatan_id
            ]);
        Alert::success('Sukses!', 'Data pejabat BUMDes berhasil diubah!');
        return redirect()->route('pejabat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $pejabat_id = $request->pejabat_id;
        PejabatBumdes::destroy($pejabat_id);
        Alert::success('Sukses!', 'Data pejabat BUMDes berhasil dihapus!');
        return redirect()->route('pejabat.index');
    }
}
