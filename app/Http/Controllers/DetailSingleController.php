<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class DetailSingleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $single = $request->route('single');
        $singles = Peminjam::where('id', $single)->get();
        $pinjamans = Pinjaman::where('peminjam_id', $single)->get();
        return view('dashboard.admin.detail-peminjam-single.index', [
            'title' => 'Detail Peminjam ' . Peminjam::where('id', $single)->first()->nama,
            'singles' => $singles,
            'pinjamans' => $pinjamans,
            'single' => $single,
            'single_name' => Peminjam::where('id', $single)->first()->nama
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
