<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Peminjam;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Alert;
use Carbon\Carbon;

class AngsuranSingleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $single = $request->route('single');
        $pinjaman_single = $request->route('pinjaman_single');
        $angsurans = Angsuran::where('pinjaman_id', $pinjaman_single)->get();
        $pinjaman = Pinjaman::where('id', $pinjaman_single)->get();
        $single_name = Peminjam::where('id', $single)->first()->nama;
        $tgl_lunas = Pinjaman::where('id', $pinjaman_single)->first()->tgl_pelunasan;
        $tgl_pinjaman = Pinjaman::where('id', $pinjaman_single)->first()->tgl_pinjaman;

        $bulan_iuran = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($tgl_lunas));

        return view('dashboard.admin.angsuran-single.index', [
            'title' => 'Riwayat Angsuran single ' . $single_name,
            'pinjaman' => $pinjaman,
            'single' => $single,
            'tgl_lunas' => $tgl_lunas,
            'tgl_pinjaman' => $tgl_pinjaman,
            'bulan_iuran' => $bulan_iuran,
            'periode' => Pinjaman::where('id', $pinjaman_single)->first()->periode_pinjaman,
            'pinjaman_single' => $pinjaman_single,
            'single_name' => $single_name,
            'angsurans' => $angsurans
        ]);
    }

    public function daftarPeminjam()
    {
        $singles = Peminjam::where('jenis_peminjam', 2)->get();
        return view('dashboard.admin.angsuran-single.peminjam', [
            'title' => 'Peminjam Perorangan',
            'singles' => $singles,
            'pinjamans' => Pinjaman::all()
        ]);
    }

    public function daftarPinjaman(Request $request)
    {
        $single = $request->route('single');
        $single_name = Peminjam::where('id', $single)->first()->nama;

        return view('dashboard.admin.angsuran-single.pinjaman', [
            'title' => 'Pinjaman ' . $single_name,
            'single' => $single,
            'single_name' => $single_name,
            'pinjamans' => Pinjaman::where('peminjam_id', $single)->get()
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
        $single_id = $request->single_id;
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

        if(Angsuran::where('pinjaman_id', $pinjaman_id)->count() == 0){
            if(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran)) == 0){
                $data->iuran = (1.3 / 100) * $nilai_pinjaman;
                $data->total_iuran_dibayarkan = (1.3 / 100) * $nilai_pinjaman;
                $data->pokok = $request->angsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman);
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $request->angsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman);
                $data->total_simpanan = 0;
                $data->pokok_tunggakan = $nilai_pinjaman - $request->angsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman);
            }elseif(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran)) > 0){
                $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran));
                $data->iuran = ((1.3 / 100) * $nilai_pinjaman) * $rentang;
                $data->total_iuran_dibayarkan = ((1.3 / 100) * $nilai_pinjaman) * $rentang;
                $data->pokok = $request->angsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman * $rentang);
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $request->angsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman * $rentang);;
                $data->total_simpanan = 0;
                $data->pokok_tunggakan = $nilai_pinjaman - ($request->angsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman * $rentang));
            }
        }elseif(Angsuran::where('pinjaman_id', $pinjaman_id)->count() > 0){
            $angsuran_terakhir = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran;
            if(Carbon::parse($angsuran_terakhir)->diffInMonths(Carbon::parse($request->tgl_angsuran)) == 0){
                $data->iuran = 0;
                $data->total_iuran_dibayarkan = $total_iuran;
                $data->pokok = $request->angsuran_dibayarkan;
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $total_pokok + $request->angsuran_dibayarkan;
                $data->total_simpanan = 0;
                $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + $request->angsuran_dibayarkan);
            }elseif(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran)) > 0){
                $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->tgl_angsuran));
                $rentang_akhir = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($angsuran_terakhir));
                $data->iuran = ((1.3 / 100) * ($nilai_pinjaman - $total_pokok)) * ($rentang - $rentang_akhir);
                $data->total_iuran_dibayarkan = $total_iuran + ((1.3 / 100) * ($nilai_pinjaman - $total_pokok)) * ($rentang - $rentang_akhir);
                $data->pokok = $request->angsuran_dibayarkan - (((1.3 / 100) * ($nilai_pinjaman - $total_pokok)) * ($rentang - $rentang_akhir));
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $total_pokok + ($request->angsuran_dibayarkan - (((1.3 / 100) * ($nilai_pinjaman - $total_pokok)) * ($rentang - $rentang_akhir)));
                $data->total_simpanan = 0;
                $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + ($request->angsuran_dibayarkan - (((1.3 / 100) * ($nilai_pinjaman - $total_pokok)) * ($rentang - $rentang_akhir))));
            }
        }
        $data->save();
        $jml_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        if($data->total_pokok_dibayarkan >=  $jml_pinjaman){
            $sisa = $data->total_pokok_dibayarkan - $jml_pinjaman;
            Pinjaman::where('id', $pinjaman_id)->update([
                'keterangan' => 1,
                'tgl_pelunasan' => $data->tgl_angsuran
            ]);
            Angsuran::where('id', $data->id)->update([
                'total_simpanan' => $data->total_simpanan + $sisa,
                'simpanan' => $sisa
            ]);
        }else{
            Pinjaman::where('id', $pinjaman_id)->update([
                'keterangan' => 0,
                'tgl_pelunasan' => null
            ]);
        }
        Alert::success('Sukses!', 'Data Riwayat Angsuran Perorangan berhasil ditambahkan!');
        return redirect()->route('riwayat-angsuran-single.index', ['single' => $single_id, 'pinjaman_single' => $pinjaman_id]);
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
        $single_id = $request->single_id;
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

        if(Angsuran::where('pinjaman_id', $pinjaman_id)->count() == 0 || $data->id == Angsuran::where('pinjaman_id', $pinjaman_id)->oldest()->first()->id){
            if(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) == 0){
                $data->iuran = (1.3 / 100) * $nilai_pinjaman;
                $data->total_iuran_dibayarkan = (1.3 / 100) * $nilai_pinjaman;
                $data->pokok = $request->eangsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman);
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $request->eangsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman);
                $data->total_simpanan = 0;
                $data->pokok_tunggakan = $nilai_pinjaman - $request->eangsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman);
            }elseif(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) > 0){
                $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran));
                $data->iuran = ((1.3 / 100) * $nilai_pinjaman) * $rentang;
                $data->total_iuran_dibayarkan = ((1.3 / 100) * $nilai_pinjaman) * $rentang;
                $data->pokok = $request->eangsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman * $rentang);
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $request->eangsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman * $rentang);;
                $data->total_simpanan = 0;
                $data->pokok_tunggakan = $nilai_pinjaman - ($request->eangsuran_dibayarkan - ((1.3 / 100) * $nilai_pinjaman * $rentang));
            }
        }elseif(Angsuran::where('pinjaman_id', $pinjaman_id)->count() > 0 && $data->id != Angsuran::where('pinjaman_id', $pinjaman_id)->oldest()->first()->id){
            $angsuran_terakhir = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran;
            if(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) == 0){
                $data->iuran = 0;
                $data->total_iuran_dibayarkan = $total_iuran - $iuran_now;
                $data->pokok = $request->eangsuran_dibayarkan;
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $total_pokok - $pokok_now + $request->eangsuran_dibayarkan;
                $data->total_simpanan = 0;
                $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok - $pokok_now + $request->eangsuran_dibayarkan);
            }elseif(Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran)) > 0){
                $rentang = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($request->etgl_angsuran));
                $rentang_akhir = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($angsuran_terakhir));
                $data->iuran = ((1.3 / 100) * ($nilai_pinjaman - $total_pokok - $pokok_now)) * ($rentang - $rentang_akhir);
                $data->total_iuran_dibayarkan = $total_iuran - $iuran_now + ((1.3 / 100) * ($nilai_pinjaman - $total_pokok - $pokok_now)) * ($rentang - $rentang_akhir);
                $data->pokok = $request->eangsuran_dibayarkan - (((1.3 / 100) * ($nilai_pinjaman - $total_pokok - $pokok_now)) * ($rentang - $rentang_akhir));
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $total_pokok - $pokok_now + ($request->eangsuran_dibayarkan - (((1.3 / 100) * ($nilai_pinjaman - $total_pokok - $pokok_now)) * ($rentang - $rentang_akhir)));
                $data->total_simpanan = 0;
                $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok - $pokok_now + ($request->eangsuran_dibayarkan - (((1.3 / 100) * ($nilai_pinjaman - $total_pokok - $pokok_now)) * ($rentang - $rentang_akhir))));
            }
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
        Alert::success('Sukses!', 'Data Riwayat Angsuran Perorangan berhasil diubah!');
        return redirect()->route('riwayat-angsuran-single.index', ['single' => $single_id, 'pinjaman_single' => $pinjaman_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $single_id = $request->single_id;
        $pinjaman_id = $request->pinjaman_id;
        $angsuran_id = $request->angsuran_id;

        $jml_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        Angsuran::destroy($angsuran_id);
        if(Angsuran::where('pinjaman_id')->count() > 0){
            if(Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->total_pokok_dibayarkan >=  $jml_pinjaman){
                $sisa = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->total_pokok_dibayarkan - $jml_pinjaman;
                Pinjaman::where('id', $pinjaman_id)->update([
                    'keterangan' => 1,
                    'tgl_pelunasan' => Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first()->tgl_angsuran
                ]);
            }else{
                Pinjaman::where('id', $pinjaman_id)->update([
                    'keterangan' => 0,
                    'tgl_pelunasan' => null
                ]);
            }
        }
        Alert::success('Sukses!', 'Data angsuran berhasil dihapus!');
        return redirect()->route('riwayat-angsuran-single.index', ['single' => $single_id, 'pinjaman_single' => $pinjaman_id]);
    }
}
