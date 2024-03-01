<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventarisExport;
use Carbon\Carbon;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventaris = Inventaris::orderBy('id', 'ASC')->get();
        return view('dashboard.admin.inventaris.index', [
            'title' => 'Referensi Jabatan',
            'inventaris' => $inventaris
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
        $harga_total = intval(str_replace('.', '', $request->harga_satuan)) * $request->jumlah_barang;
        $data = Inventaris::create([
            'tgl_pembukuan' => now(),
            'kode' => uniqid(),
            'nama' => $request->nama_barang,
            'jumlah' => $request->jumlah_barang,
            'harga_satuan' => intval(str_replace('.', '', $request->harga_satuan)),
            'harga_total' => $harga_total,
            'kondisi' => $request->kondisi_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            // 'keterangan_tambahan' => $request->keterangan_tambahan
        ]);
        Alert::success('Sukses!', 'Data inventaris berhasil ditambahkan!');
        return redirect()->route('inventaris.index');
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
        $inventaris_id = $request->inventaris_id;
        $harga_total = intval(str_replace('.', '', $request->eharga_satuan)) * $request->ejumlah_barang;
        Inventaris::where('id', $inventaris_id)
            ->update([
                'tgl_pembukuan' => $request->etgl_pembukuan,
                'kode' => $request->ekode_barang,
                'nama' => $request->enama_barang,
                'jumlah' => $request->ejumlah_barang,
                'harga_satuan' => intval(str_replace('.', '', $request->eharga_satuan)),
                'harga_total' => $harga_total,
                'kondisi' => $request->ekondisi_barang,
                'deskripsi_barang' => $request->edeskripsi_barang,
                // 'keterangan_tambahan' => $request->eketerangan_tambahan
            ]);
        Alert::success('Sukses!', 'Data inventaris berhasil diubah!');
        return redirect()->route('inventaris.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $inventaris_id = $request->inventaris_id;

        Inventaris::destroy($inventaris_id);
        Alert::success('Sukses!', 'Data inventaris berhasil dihapus!');
        return redirect()->route('inventaris.index');
    }
    public function exportInventaris(Request $request)
    {
        $date_now = Carbon::now();
        return Excel::download(new InventarisExport, 'Data Inventaris-'. $date_now . '.xlsx');
    }
}
