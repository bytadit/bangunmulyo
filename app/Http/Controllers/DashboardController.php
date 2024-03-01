<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Peminjam;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $guest_books = GuestBook::orderBy('id', 'DESC')->get();
        // $guests = Guest::orderBy('identity_number', 'ASC')->get();
        // $units = Unit::orderBy('display_name', 'ASC')->get();
        // $problems = ProblemCategory::orderBy('name', 'ASC')->get();
        return view('dashboard.admin.index', [
            'title' => 'Halaman Admin',
            'kelompoks' => Peminjam::where('jenis_peminjam', 1)->get(),
            'singles' => Peminjam::where('jenis_peminjam', 2)->get(),
            'angsurans' => Angsuran::sum('iuran'),
            'pinjaman' => Pinjaman::sum('jumlah_pinjaman'),
            'pinjamans' => Pinjaman::all()
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
