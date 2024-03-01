<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelompok;
use App\Models\Angsuran;
use App\Models\Peminjam;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Alert;

class AngsuranKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelompok = $request->route('kelompok');
        $pinjaman_kelompok = $request->route('pinjaman_kelompok');
        $angsurans = Angsuran::where('pinjaman_id', $pinjaman_kelompok)->get();
        $pinjaman = Pinjaman::where('id', $pinjaman_kelompok)->get();
        $kelompok_name = Peminjam::where('id', $kelompok)->first()->nama;
        $tgl_lunas = Pinjaman::where('id', $pinjaman_kelompok)->first()->tgl_pelunasan;
        $tgl_pinjaman = Pinjaman::where('id', $pinjaman_kelompok)->first()->tgl_pinjaman;

        $bulan_iuran = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($tgl_lunas));

        return view('dashboard.admin.angsuran-kelompok.index', [
            'title' => 'Riwayat Angsuran Kelompok ' . $kelompok_name,
            'pinjaman' => $pinjaman,
            'kelompok' => $kelompok,
            'tgl_lunas' => $tgl_lunas,
            'tgl_pinjaman' => $tgl_pinjaman,
            'bulan_iuran' => $bulan_iuran,
            'periode' => Pinjaman::where('id', $pinjaman_kelompok)->first()->periode_pinjaman,
            'pinjaman_kelompok' => $pinjaman_kelompok,
            'kelompok_name' => $kelompok_name,
            'angsurans' => $angsurans
        ]);
    }

    public function daftarPeminjam()
    {
        $kelompoks = Peminjam::where('jenis_peminjam', 1)->get();
        return view('dashboard.admin.angsuran-kelompok.peminjam', [
            'title' => 'Peminjam Kelompok',
            'kelompoks' => $kelompoks,
            'anggotas' => AnggotaKelompok::all(),
            'pinjamans' => Pinjaman::all()
        ]);
    }

    public function daftarPinjaman(Request $request)
    {
        $kelompok = $request->route('kelompok');
        $kelompok_name = Peminjam::where('id', $kelompok)->first()->nama;
        return view('dashboard.admin.angsuran-kelompok.pinjaman', [
            'title' => 'Pinjaman Kelompok ' . $kelompok_name,
            'kelompok' => $kelompok,
            'kelompok_name' => $kelompok_name,
            'pinjamans' => Pinjaman::where('peminjam_id', $kelompok)->get()
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
        $kelompok_id = $request->kelompok_id;
        $pinjaman_id = $request->pinjaman_id;
        $angsuran_id = $request->angsuran_id;
        $nilai_angsuran = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_angsuran;
        $nilai_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        $nilai_iuran = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_iuran;
        $nilai_pokok = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pokok;

        $tgl_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->tgl_pinjaman;
        $total_pokok = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('pokok');
        $total_iuran = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('iuran');
        $total_simpanan = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('simpanan');
        $data = new Angsuran;
        $data->pinjaman_id = $pinjaman_id;
        $data->tgl_angsuran = $request->tgl_angsuran;
        $data->angsuran_dibayarkan = $request->angsuran_dibayarkan;
        $data->keterangan = $request->keterangan;
        $data->iuran_tunggakan = 0;

        if (Angsuran::where('pinjaman_id', $pinjaman_id)->count() == 0) {
            if (Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran)) == 0) {
                $data->iuran = $nilai_iuran;
                $data->total_iuran_dibayarkan = $nilai_iuran;
                if ($request->angsuran_dibayarkan >= $nilai_angsuran) {
                    $data->pokok = $nilai_pokok;
                    $data->simpanan = $request->angsuran_dibayarkan - $nilai_angsuran;
                    $data->total_pokok_dibayarkan = $nilai_pokok;
                    $data->total_simpanan = $request->angsuran_dibayarkan - $nilai_angsuran;
                    $data->pokok_tunggakan = $nilai_pinjaman - $nilai_pokok;
                } else {
                    $data->pokok = $request->angsuran_dibayarkan - $nilai_iuran;
                    $data->simpanan = 0;
                    $data->total_pokok_dibayarkan = $request->angsuran_dibayarkan - $nilai_iuran;
                    $data->total_simpanan = 0;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($request->angsuran_dibayarkan - $nilai_iuran);
                }
            } elseif (Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran)) > 0) {
                $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran));
                $data->iuran = $nilai_iuran * $rentang;
                $data->total_iuran_dibayarkan = $nilai_iuran * $rentang;
                if ($request->angsuran_dibayarkan >= ($nilai_angsuran + $nilai_iuran * ($rentang - 1))) {
                    $data->pokok = $nilai_pokok;
                    $data->simpanan = $request->angsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - 1));
                    $data->total_pokok_dibayarkan = $nilai_pokok;
                    $data->total_simpanan = $request->angsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - 1));
                    $data->pokok_tunggakan = $nilai_pinjaman - $nilai_pokok;
                } else {
                    $data->pokok = $request->angsuran_dibayarkan - ($nilai_iuran * $rentang);
                    $data->simpanan = 0;
                    $data->total_pokok_dibayarkan = $request->angsuran_dibayarkan - $nilai_iuran * $rentang;
                    $data->total_simpanan = 0;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($request->angsuran_dibayarkan - ($nilai_iuran * $rentang));
                }
            }
        } elseif (Angsuran::where('pinjaman_id', $pinjaman_id)->count() > 0) {
            $angsuran_terakhir = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran;
            if (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)) == 0) {
                $data->iuran = 0;
                $data->total_iuran_dibayarkan = $total_iuran;
                if ($request->angsuran_dibayarkan >= $nilai_angsuran) {
                    $data->pokok = $nilai_pokok;
                    $data->simpanan = $request->angsuran_dibayarkan - $nilai_pokok;
                    $data->total_pokok_dibayarkan = $total_pokok + $nilai_pokok;
                    $data->total_simpanan = $total_simpanan + $request->angsuran_dibayarkan - $nilai_pokok;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $nilai_pokok);
                } else {
                    $data->pokok = $request->angsuran_dibayarkan;
                    $data->simpanan = 0;
                    $data->total_pokok_dibayarkan = $total_pokok + $request->angsuran_dibayarkan;
                    $data->total_simpanan = $total_simpanan;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $request->angsuran_dibayarkan);
                }
            } elseif (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)) > 0) {
                $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran));
                $rentang_akhir = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($angsuran_terakhir));
                $data->iuran = $nilai_iuran * ($rentang - $rentang_akhir);
                $data->total_iuran_dibayarkan = $total_iuran + ($nilai_iuran * ($rentang - $rentang_akhir));
                if ($request->angsuran_dibayarkan >= ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1))) {
                    $data->pokok = $nilai_pokok;
                    $data->simpanan = $request->angsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1));
                    $data->total_pokok_dibayarkan = $total_pokok + $nilai_pokok;
                    $data->total_simpanan = $total_simpanan + $request->angsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1));
                    $data->pokok_tunggakan = $nilai_pinjaman - $total_pokok + $nilai_pokok;
                } else {
                    $data->pokok = $request->angsuran_dibayarkan - ($nilai_iuran * ($rentang - $rentang_akhir));
                    $data->simpanan = 0;
                    $data->total_pokok_dibayarkan = $total_pokok + ($request->angsuran_dibayarkan - $nilai_iuran * ($rentang - $rentang_akhir));
                    $data->total_simpanan = $total_simpanan;
                    $data->pokok_tunggakan = $nilai_pinjaman - $total_pokok + ($request->angsuran_dibayarkan - ($nilai_iuran * ($rentang - $rentang_akhir)));
                }
            }

            // $angsuran_terakhir = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran;
            // $data->iuran = $nilai_iuran * (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)));
            // $data->total_iuran_dibayarkan = $nilai_iuran * (Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran)));
            // if($request->angsuran_dibayarkan >= $nilai_angsuran){
            //     $data->pokok = $nilai_pokok;
            //     $data->simpanan = $request->angsuran_dibayarkan - $nilai_angsuran;
            //     $data->total_pokok_dibayarkan = $total_pokok + $nilai_pokok;
            //     $data->total_simpanan = $total_simpanan + ($request->angsuran_dibayarkan - $nilai_angsuran);
            //     $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $nilai_pokok);
            // }else{
            //     $data->pokok = $request->angsuran_dibayarkan - ($nilai_iuran * (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran))));
            //     $data->simpanan = 0;
            //     $data->total_pokok_dibayarkan = $total_pokok + ($request->angsuran_dibayarkan - ($nilai_iuran * (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)))));
            //     $data->total_simpanan = $total_simpanan;
            //     $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $request->angsuran_dibayarkan - ($nilai_iuran * (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)))));
            // }
        }
        $data->save();
        $jml_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        if ($data->total_pokok_dibayarkan >=  $jml_pinjaman) {
            $sisa = $data->total_pokok_dibayarkan - $jml_pinjaman;
            Pinjaman::where('id', $pinjaman_id)->update([
                'keterangan' => 1,
                'tgl_pelunasan' => $data->tgl_angsuran
            ]);
            Angsuran::where('id', $data->id)->update([
                'total_simpanan' => $data->total_simpanan + $sisa,
                'simpanan' => $sisa
            ]);
        } else {
            Pinjaman::where('id', $pinjaman_id)->update([
                'keterangan' => 0,
                'tgl_pelunasan' => null
            ]);
        }
        Alert::success('Sukses!', 'Data Riwayat Angsuran Kelompok berhasil ditambahkan!');
        return redirect()->route('riwayat-angsuran-kelompok.index', ['kelompok' => $kelompok_id, 'pinjaman_kelompok' => $pinjaman_id]);
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
        $kelompok_id = $request->kelompok_id;
        $pinjaman_id = $request->pinjaman_id;
        $angsuran_id = $request->angsuran_id;
        $nilai_angsuran = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_angsuran;
        $nilai_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        $nilai_iuran = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_iuran;
        $nilai_pokok = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pokok;

        $tgl_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->tgl_pinjaman;
        $total_pokok = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('pokok');
        $total_iuran = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('iuran');
        $total_simpanan = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('simpanan');

        $iuran_now = Angsuran::where('id', $angsuran_id)->first()->iuran;
        $pokok_now = Angsuran::where('id', $angsuran_id)->first()->pokok;
        $simpanan_now = Angsuran::where('id', $angsuran_id)->first()->simpanan;

        $data = Angsuran::find($angsuran_id);
        $data->pinjaman_id = $pinjaman_id;
        $data->tgl_angsuran = $request->etgl_angsuran;
        $data->angsuran_dibayarkan = $request->eangsuran_dibayarkan;
        $data->keterangan = $request->eketerangan;
        $data->iuran_tunggakan = 0;

        // $angsuran_terakhir = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran;
        // if (Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) <= 1) {
        //     $data->iuran = 0;
        //     $data->total_iuran_dibayarkan = $nilai_iuran;
        //     if ($request->eangsuran_dibayarkan >= $nilai_angsuran) {
        //         $data->pokok = $nilai_pokok;
        //         $data->simpanan = $request->eangsuran_dibayarkan - $nilai_pokok;
        //         $data->total_pokok_dibayarkan = $total_pokok + $nilai_pokok;
        //         $data->total_simpanan = $total_simpanan + $request->eangsuran_dibayarkan - $nilai_pokok;
        //         $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $nilai_pokok);
        //     } else {
        //         $data->pokok = $request->eangsuran_dibayarkan;
        //         $data->simpanan = 0;
        //         $data->total_pokok_dibayarkan = $total_pokok + $request->eangsuran_dibayarkan;
        //         $data->total_simpanan = $total_simpanan;
        //         $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $request->eangsuran_dibayarkan);
        //     }
        // } elseif (Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) > 1) {
        //     $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran));
        //     $rentang_akhir = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($angsuran_terakhir));
        //     $data->iuran = $nilai_iuran * ($rentang - $rentang_akhir);
        //     $data->total_iuran_dibayarkan = $nilai_iuran * ($rentang - $rentang_akhir);
        //     if ($request->eangsuran_dibayarkan >= ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1))) {
        //         $data->pokok = $nilai_pokok;
        //         $data->simpanan = $request->eangsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1));
        //         $data->total_pokok_dibayarkan = $nilai_pokok;
        //         $data->total_simpanan = $request->eangsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1));
        //         $data->pokok_tunggakan = $nilai_pinjaman - $nilai_pokok;
        //     } else {
        //         $data->pokok = $request->eangsuran_dibayarkan - ($nilai_iuran * ($rentang - $rentang_akhir));
        //         $data->simpanan = 0;
        //         $data->total_pokok_dibayarkan = $request->eangsuran_dibayarkan - $nilai_iuran * ($rentang - $rentang_akhir);
        //         $data->total_simpanan = 0;
        //         $data->pokok_tunggakan = $nilai_pinjaman - ($request->eangsuran_dibayarkan - ($nilai_iuran * ($rentang - $rentang_akhir)));
        //     }
        // }

        if(Angsuran::where('pinjaman_id', $pinjaman_id)->count() == 0 || $data->id == Angsuran::where('pinjaman_id', $pinjaman_id)->oldest()->first()->id){
            if(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) == 0){
                $data->iuran = $nilai_iuran;
                $data->total_iuran_dibayarkan = $nilai_iuran;
                if($request->eangsuran_dibayarkan >= $nilai_angsuran){
                    $data->pokok = $nilai_pokok;
                    $data->simpanan = $request->eangsuran_dibayarkan - $nilai_angsuran;
                    $data->total_pokok_dibayarkan = $nilai_pokok;
                    $data->total_simpanan = $request->eangsuran_dibayarkan - $nilai_angsuran;
                    $data->pokok_tunggakan = $nilai_pinjaman - $nilai_pokok;
                }else{
                    $data->pokok = $request->eangsuran_dibayarkan - $nilai_iuran;
                    $data->simpanan = 0;
                    $data->total_pokok_dibayarkan = $request->eangsuran_dibayarkan - $nilai_iuran;
                    $data->total_simpanan = 0;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($request->eangsuran_dibayarkan - $nilai_iuran);
                }
            }elseif(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) > 0){
                $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran));
                $data->iuran = $nilai_iuran * $rentang;
                $data->total_iuran_dibayarkan = $nilai_iuran * $rentang;
                if($request->eangsuran_dibayarkan >= ($nilai_angsuran + $nilai_iuran * ($rentang - 1))){
                    $data->pokok = $nilai_pokok;
                    $data->simpanan = $request->eangsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - 1));
                    $data->total_pokok_dibayarkan = $nilai_pokok;
                    $data->total_simpanan = $request->eangsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - 1));
                    $data->pokok_tunggakan = $nilai_pinjaman - $nilai_pokok;
                }else{
                    $data->pokok = $request->eangsuran_dibayarkan - ($nilai_iuran * $rentang);
                    $data->simpanan = 0;
                    $data->total_pokok_dibayarkan = $request->eangsuran_dibayarkan - $nilai_iuran * $rentang;
                    $data->total_simpanan = 0;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($request->eangsuran_dibayarkan - ($nilai_iuran * $rentang));
                }
            }
        }elseif(Angsuran::where('pinjaman_id', $pinjaman_id)->count() > 0 && $data->id != Angsuran::where('pinjaman_id', $pinjaman_id)->oldest()->first()->id){
            $angsuran_terakhir = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran;
            if(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) == 0){
                $data->iuran = 0;
                $data->total_iuran_dibayarkan = $nilai_iuran;
                if($request->eangsuran_dibayarkan >= $nilai_angsuran){
                    $data->pokok = $nilai_pokok;
                    $data->simpanan = $request->eangsuran_dibayarkan - $nilai_pokok;
                    $data->total_pokok_dibayarkan = $total_pokok + $nilai_pokok;
                    $data->total_simpanan = $total_simpanan + $request->eangsuran_dibayarkan - $nilai_pokok;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $nilai_pokok);
                }else{
                    $data->pokok = $request->eangsuran_dibayarkan;
                    $data->simpanan = 0;
                    $data->total_pokok_dibayarkan = $total_pokok + $request->eangsuran_dibayarkan;
                    $data->total_simpanan = $total_simpanan;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $request->eangsuran_dibayarkan);
                }
            }elseif(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) > 0){
                $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran));
                $rentang_akhir = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($angsuran_terakhir));
                $data->iuran = $nilai_iuran * ($rentang - $rentang_akhir);
                $data->total_iuran_dibayarkan = $nilai_iuran * ($rentang - $rentang_akhir);
                if($request->eangsuran_dibayarkan >= ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1))){
                    $data->pokok = $nilai_pokok;
                    $data->simpanan = $request->eangsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1));
                    $data->total_pokok_dibayarkan = $total_pokok - $pokok_now + $nilai_pokok;
                    $data->total_simpanan = $total_simpanan - $simpanan_now + $request->eangsuran_dibayarkan - ($nilai_angsuran + $nilai_iuran * ($rentang - $rentang_akhir - 1));
                    $data->pokok_tunggakan = $nilai_pinjaman - $total_pokok - $pokok_now + $nilai_pokok;
                }else{
                    $data->pokok = $request->eangsuran_dibayarkan - ($nilai_iuran * ($rentang - $rentang_akhir));
                    $data->simpanan = 0;
                    $data->total_pokok_dibayarkan = $request->eangsuran_dibayarkan - $nilai_iuran * ($rentang - $rentang_akhir);
                    $data->total_simpanan = $total_simpanan - $simpanan_now;
                    $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok - $pokok_now + $request->eangsuran_dibayarkan - ($nilai_iuran * ($rentang - $rentang_akhir)));
                }
            }
            // $angsuran_terakhir = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran;
            // $data->iuran = $nilai_iuran * (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)));
            // $data->total_iuran_dibayarkan = $nilai_iuran * (Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran)));
            // if($request->angsuran_dibayarkan >= $nilai_angsuran){
            //     $data->pokok = $nilai_pokok;
            //     $data->simpanan = $request->angsuran_dibayarkan - $nilai_angsuran;
            //     $data->total_pokok_dibayarkan = $total_pokok + $nilai_pokok;
            //     $data->total_simpanan = $total_simpanan + ($request->angsuran_dibayarkan - $nilai_angsuran);
            //     $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $nilai_pokok);
            // }else{
            //     $data->pokok = $request->angsuran_dibayarkan - ($nilai_iuran * (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran))));
            //     $data->simpanan = 0;
            //     $data->total_pokok_dibayarkan = $total_pokok + ($request->angsuran_dibayarkan - ($nilai_iuran * (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)))));
            //     $data->total_simpanan = $total_simpanan;
            //     $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $request->angsuran_dibayarkan - ($nilai_iuran * (Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)))));
            // }
        }
        $data->save();
        $jml_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        if ($data->total_pokok_dibayarkan >=  $jml_pinjaman) {
            $sisa = $data->total_pokok_dibayarkan - $jml_pinjaman;
            Pinjaman::where('id', $pinjaman_id)->update([
                'keterangan' => 1,
                'tgl_pelunasan' => $data->tgl_angsuran
            ]);
            Angsuran::where('id', $data->id)->update([
                'total_simpanan' => $data->total_simpanan + $sisa,
                'simpanan' => $sisa
            ]);
        } else {
            Pinjaman::where('id', $pinjaman_id)->update([
                'keterangan' => 0,
                'tgl_pelunasan' => null
            ]);
        }
        Alert::success('Sukses!', 'Data Riwayat Angsuran Kelompok berhasil diubah!');
        return redirect()->route('riwayat-angsuran-kelompok.index', ['kelompok' => $kelompok_id, 'pinjaman_kelompok' => $pinjaman_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $kelompok_id = $request->kelompok_id;
        $pinjaman_id = $request->pinjaman_id;
        $angsuran_id = $request->angsuran_id;

        $jml_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        Angsuran::destroy($angsuran_id);
        if(Angsuran::where('pinjaman_id')->count() > 0){
            if (Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->total_pokok_dibayarkan >=  $jml_pinjaman) {
                $sisa = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->total_pokok_dibayarkan - $jml_pinjaman;
                Pinjaman::where('id', $pinjaman_id)->update([
                    'keterangan' => 1,
                    'tgl_pelunasan' => Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran
                ]);
            } else {
                Pinjaman::where('id', $pinjaman_id)->update([
                    'keterangan' => 0,
                    'tgl_pelunasan' => null
                ]);
            }
        }
        Alert::success('Sukses!', 'Data angsuran berhasil dihapus!');
        return redirect()->route('riwayat-angsuran-kelompok.index', ['kelompok' => $kelompok_id, 'pinjaman_kelompok' => $pinjaman_id]);
    }
}
