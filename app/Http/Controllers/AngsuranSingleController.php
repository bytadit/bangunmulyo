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
        if(Angsuran::where('pinjaman_id', $pinjaman_single)->count() > 0){
            $last_angsuran =  Angsuran::where('pinjaman_id', $pinjaman_single)->orderBy('tgl_angsuran', 'DESC')->first()->tgl_angsuran;
        }elseif(Angsuran::where('pinjaman_id', $pinjaman_single)->count() == 0){
            $last_angsuran =  Carbon::now();
        }

        $bulan_iuran = Carbon::parse($tgl_pinjaman)->diffInMonths(Carbon::parse($tgl_lunas));

        return view('dashboard.admin.angsuran-single.index', [
            'title' => 'Riwayat Angsuran single ' . $single_name,
            'pinjaman' => $pinjaman,
            'single' => $single,
            'tgl_lunas' => $tgl_lunas,
            'last_angsuran' => Carbon::parse($last_angsuran)->addDay(),
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
        // defining variables
        $single_id = $request->single_id;
        // $kelompok_id = $request->kelompok_id;
        $pinjaman_id = $request->pinjaman_id;
        $angsuran_id = $request->angsuran_id;
        // nilai
        $nilai_angsuran = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_angsuran;
        $nilai_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        $nilai_iuran = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_iuran;
        $nilai_pokok = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pokok;
        // jumlah
        $total_pokok = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('pokok');
        $total_iuran = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('iuran');
        $total_simpanan = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('simpanan');
        $tgl_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->tgl_pinjaman;
        // tanggal
        $tanggalPeminjaman = Carbon::parse($tgl_pinjaman);
        $bulanTahunPeminjaman = Carbon::parse($tanggalPeminjaman->format('Y-m'));
        $tanggalAngsuranBaru =  Carbon::parse($request->tgl_angsuran);
        $bulanTahunAngsuranBaru = Carbon::parse($tanggalAngsuranBaru->format('Y-m'));
        // start storing data
        $data = new Angsuran;
        $data->pinjaman_id = $pinjaman_id;
        $data->angsuran_ke = Angsuran::where('pinjaman_id', $pinjaman_id)->count() + 1;
        $data->tgl_angsuran = $request->tgl_angsuran;
        $data->angsuran_dibayarkan = intval(str_replace('.', '', $request->angsuran_dibayarkan));
        $data->keterangan = $request->keterangan;
        // $data->iuran_tunggakan = 0; //next we will delete this attribute
        if(Angsuran::where('pinjaman_id', $pinjaman_id)->count() == 0){
            // cek apakah antara tanggal pinjaman dan tanggal angsuran baru tidak ada perbedaan antara bulan dan tahun
            // jika bulan dan tahun sama
            if ($bulanTahunPeminjaman == $bulanTahunAngsuranBaru) {
                $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths(1);
                $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                $data->iuran = $nilai_iuran;
                $data->total_iuran_dibayarkan = $nilai_iuran;
                $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran;
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran;
                $data->total_simpanan = 0; // karena belum ada data sebelumnya
                $data->pokok_tunggakan = $nilai_pinjaman - intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran;
                // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
            }elseif($bulanTahunPeminjaman != $bulanTahunAngsuranBaru){
                $perbedaanBulan = $bulanTahunPeminjaman->diffInMonths($bulanTahunAngsuranBaru);
                if ($perbedaanBulan == 1) {
                    // Cek apakah tanggal angsuran yang akan diinputkan sudah melewati tanggal jatuh tempo di bulan tersebut
                    $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths(1);
                    $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                    if ($tanggalAngsuranBaru >= $jatuhTempoBulanIni) {
                        $data->iuran = $nilai_iuran;
                        $data->total_iuran_dibayarkan = $nilai_iuran;
                        $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran);
                        // bermasalah disini
                    } elseif($tanggalAngsuranBaru < $jatuhTempoBulanIni) {
                        $data->iuran = $nilai_iuran;
                        $data->total_iuran_dibayarkan = $nilai_iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $nilai_iuran;
                    }
                }elseif($perbedaanBulan > 1){
                    // Cek apakah tanggal angsuran yang akan diinputkan sudah melewati tanggal jatuh tempo di bulan tersebut
                    $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths($perbedaanBulan);
                    $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                    if ($tanggalAngsuranBaru >= $jatuhTempoBulanIni) {
                        // Tarik iuran sesuai dengan selisih bulan
                        $iuran = $nilai_pinjaman * ((1.013)**($perbedaanBulan) - 1);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran);
                    } elseif($tanggalAngsuranBaru < $jatuhTempoBulanIni) {
                        // Cukup bayar iuran di bulan sebelumnya
                        $iuran = $nilai_pinjaman * ((1.013)**($perbedaanBulan) - 1);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran);
                    }
                }
            }
        }
        // if not a new input, there're some data
        elseif(Angsuran::where('pinjaman_id', $pinjaman_id)->count() > 0){
            $angsuranTerakhir = Angsuran::where('pinjaman_id', $pinjaman_id)->orderBy('tgl_angsuran', 'DESC')->first()->tgl_angsuran;
            $tanggalAngsuranTerakhir = Carbon::parse($angsuranTerakhir);
            $bulanTahunAngsuranTerakhir = Carbon::parse($tanggalAngsuranTerakhir->format('Y-m'));
            // jika bulan dan tahun sama
            if ($bulanTahunAngsuranTerakhir == $bulanTahunAngsuranBaru) {
                $perbedaanBulanPinjaman = $bulanTahunPeminjaman->diffInMonths($bulanTahunAngsuranBaru);
                $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths($perbedaanBulanPinjaman);
                $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                $iuran = (1.3/100)*($nilai_pinjaman - $total_pokok);
                $data->iuran = $iuran;
                $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $total_pokok + intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                $data->total_simpanan = 0; // karena belum ada data sebelumnya
                $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran);
            }elseif($bulanTahunAngsuranTerakhir != $bulanTahunAngsuranBaru){
                $perbedaanBulan = $bulanTahunAngsuranTerakhir->diffInMonths($bulanTahunAngsuranBaru);
                $perbedaanBulanPinjaman = $bulanTahunPeminjaman->diffInMonths($bulanTahunAngsuranBaru);
                if ($perbedaanBulan == 1) {
                    // Cek apakah tanggal angsuran yang akan diinputkan sudah melewati tanggal jatuh tempo di bulan tersebut
                    $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths($perbedaanBulanPinjaman);
                    $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                    if ($tanggalAngsuranBaru >= $jatuhTempoBulanIni) {
                        $iuran = (1.3/100)*($nilai_pinjaman - $total_pokok);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = $total_pokok + (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran);
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran));
                        // bermasalah disini
                    } elseif($tanggalAngsuranBaru < $jatuhTempoBulanIni) {
                        $iuran = (1.3/100)*($nilai_pinjaman - $total_pokok);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = $total_pokok + intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran);
                    }
                }elseif($perbedaanBulan > 1){
                    // Cek apakah tanggal angsuran yang akan diinputkan sudah melewati tanggal jatuh tempo di bulan tersebut
                    $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths($perbedaanBulanPinjaman);
                    $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                    if ($tanggalAngsuranBaru >= $jatuhTempoBulanIni) {
                        // Tarik iuran sesuai dengan selisih bulan
                        $iuran = ($nilai_pinjaman - $total_pokok) * ((1.013)**($perbedaanBulan) - 1);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = $total_pokok + (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran);
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran));
                    } elseif($tanggalAngsuranBaru < $jatuhTempoBulanIni) {
                        // Cukup bayar iuran di bulan sebelumnya
                        $iuran = ($nilai_pinjaman - $total_pokok) * ((1.013)**($perbedaanBulan) - 1);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                        $data->pokok = intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = $total_pokok + (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran);
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + (intval(str_replace('.', '', $request->angsuran_dibayarkan)) - $iuran));
                    }
                }
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
        $angsuran_ke = $request->angsuran_ke;
        $angsuran_id = $request->angsuran_id;
        $nilai_angsuran = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_angsuran;
        $nilai_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        $nilai_iuran = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_iuran;
        $nilai_pokok = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pokok;

        $tgl_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->tgl_pinjaman;
        $tanggalPeminjaman = Carbon::parse($tgl_pinjaman);
        $bulanTahunPeminjaman = Carbon::parse($tanggalPeminjaman->format('Y-m'));
        $tanggalAngsuranBaru =  Carbon::parse($request->etgl_angsuran);
        $bulanTahunAngsuranBaru = Carbon::parse($tanggalAngsuranBaru->format('Y-m'));

        $data = Angsuran::find($angsuran_id);
        $data->pinjaman_id = $pinjaman_id;
        $data->angsuran_ke = $angsuran_ke;
        $data->tgl_angsuran = $request->etgl_angsuran;
        $data->angsuran_dibayarkan = intval(str_replace('.', '', $request->eangsuran_dibayarkan));
        $data->keterangan = $request->eketerangan;

        if(Angsuran::where('pinjaman_id', $pinjaman_id)->count() == 0 || $data->id == Angsuran::where('pinjaman_id', $pinjaman_id)->oldest()->first()->id){
            // cek apakah antara tanggal pinjaman dan tanggal angsuran baru tidak ada perbedaan antara bulan dan tahun
            // jika bulan dan tahun sama
            if ($bulanTahunPeminjaman == $bulanTahunAngsuranBaru) {
                $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths(1);
                $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                $data->iuran = $nilai_iuran;
                $data->total_iuran_dibayarkan = $nilai_iuran;
                $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran;
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran;
                $data->total_simpanan = 0; // karena belum ada data sebelumnya
                $data->pokok_tunggakan = $nilai_pinjaman - intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran;
                // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
            }elseif($bulanTahunPeminjaman != $bulanTahunAngsuranBaru){
                $perbedaanBulan = $bulanTahunPeminjaman->diffInMonths($bulanTahunAngsuranBaru);
                if ($perbedaanBulan == 1) {
                    // Cek apakah tanggal angsuran yang akan diinputkan sudah melewati tanggal jatuh tempo di bulan tersebut
                    $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths(1);
                    $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                    if ($tanggalAngsuranBaru >= $jatuhTempoBulanIni) {
                        $data->iuran = $nilai_iuran;
                        $data->total_iuran_dibayarkan = $nilai_iuran;
                        $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran);
                        // bermasalah disini
                    } elseif($tanggalAngsuranBaru < $jatuhTempoBulanIni) {
                        $data->iuran = $nilai_iuran;
                        $data->total_iuran_dibayarkan = $nilai_iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $nilai_iuran;
                    }
                }elseif($perbedaanBulan > 1){
                    // Cek apakah tanggal angsuran yang akan diinputkan sudah melewati tanggal jatuh tempo di bulan tersebut
                    $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths($perbedaanBulan);
                    $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                    if ($tanggalAngsuranBaru >= $jatuhTempoBulanIni) {
                        // Tarik iuran sesuai dengan selisih bulan
                        $iuran = $nilai_pinjaman * ((1.013)**($perbedaanBulan) - 1);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran);
                    } elseif($tanggalAngsuranBaru < $jatuhTempoBulanIni) {
                        // Cukup bayar iuran di bulan sebelumnya
                        $iuran = $nilai_pinjaman * ((1.013)**($perbedaanBulan) - 1);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran);
                    }
                }
            }
        }
        // if not a new input, there're some data
        elseif(Angsuran::where('pinjaman_id', $pinjaman_id)->count() > 0 && $data->id != Angsuran::where('pinjaman_id', $pinjaman_id)->oldest()->first()->id){
            $total_pokok = Angsuran::where('pinjaman_id', $pinjaman_id)
                        ->where('id', '<', $data->id)
                        ->orderBy('tgl_angsuran', 'DESC')
                        ->sum('pokok');
            $total_iuran = Angsuran::where('pinjaman_id', $pinjaman_id)
                        ->where('id', '<', $data->id)
                        ->orderBy('tgl_angsuran', 'DESC')
                        ->sum('iuran');
            $total_simpanan = Angsuran::where('pinjaman_id', $pinjaman_id)
                        ->where('id', '<', $data->id)
                        ->orderBy('tgl_angsuran', 'DESC')
                        ->sum('simpanan');
            $angsuranTerakhir = Angsuran::where('pinjaman_id', $pinjaman_id)
                        ->where('id', '<', $data->id) // Exclude the updated record
                        ->orderBy('tgl_angsuran', 'DESC')
                        ->first()->tgl_angsuran;
            $tanggalAngsuranTerakhir = Carbon::parse($angsuranTerakhir);
            $bulanTahunAngsuranTerakhir = Carbon::parse($tanggalAngsuranTerakhir->format('Y-m'));
            // jika bulan dan tahun sama
            if ($bulanTahunAngsuranTerakhir == $bulanTahunAngsuranBaru) {
                $perbedaanBulanPinjaman = $bulanTahunPeminjaman->diffInMonths($bulanTahunAngsuranBaru);
                $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths($perbedaanBulanPinjaman);
                $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                $iuran = (1.3/100)*($nilai_pinjaman - $total_pokok);
                $data->iuran = $iuran;
                $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                $data->simpanan = 0;
                $data->total_pokok_dibayarkan = $total_pokok + intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                $data->total_simpanan = 0; // karena belum ada data sebelumnya
                $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran);
            }elseif($bulanTahunAngsuranTerakhir != $bulanTahunAngsuranBaru){
                $perbedaanBulan = $bulanTahunAngsuranTerakhir->diffInMonths($bulanTahunAngsuranBaru);
                $perbedaanBulanPinjaman = $bulanTahunPeminjaman->diffInMonths($bulanTahunAngsuranBaru);
                if ($perbedaanBulan == 1) {
                    // Cek apakah tanggal angsuran yang akan diinputkan sudah melewati tanggal jatuh tempo di bulan tersebut
                    $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths($perbedaanBulanPinjaman);
                    $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                    if ($tanggalAngsuranBaru >= $jatuhTempoBulanIni) {
                        $iuran = (1.3/100)*($nilai_pinjaman - $total_pokok);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = $total_pokok + (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran);
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran));
                        // bermasalah disini
                    } elseif($tanggalAngsuranBaru < $jatuhTempoBulanIni) {
                        $iuran = (1.3/100)*($nilai_pinjaman - $total_pokok);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = $total_pokok + intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran);
                    }
                }elseif($perbedaanBulan > 1){
                    // Cek apakah tanggal angsuran yang akan diinputkan sudah melewati tanggal jatuh tempo di bulan tersebut
                    $jatuhTempoBulanIni = $tanggalPeminjaman->copy()->addMonths($perbedaanBulanPinjaman);
                    $data->tgl_jatuh_tempo = $jatuhTempoBulanIni;
                    if ($tanggalAngsuranBaru >= $jatuhTempoBulanIni) {
                        // Tarik iuran sesuai dengan selisih bulan
                        $iuran = ($nilai_pinjaman - $total_pokok) * ((1.013)**($perbedaanBulan) - 1);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                        // cek apakah angsuran yang dimasukkan melebihi nilai angsuran standar
                        $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = $total_pokok + (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran);
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran));
                    } elseif($tanggalAngsuranBaru < $jatuhTempoBulanIni) {
                        // Cukup bayar iuran di bulan sebelumnya
                        $iuran = ($nilai_pinjaman - $total_pokok) * ((1.013)**($perbedaanBulan) - 1);
                        $data->iuran = $iuran;
                        $data->total_iuran_dibayarkan = $total_iuran + $iuran;
                        $data->pokok = intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran;
                        $data->simpanan = 0;
                        $data->total_pokok_dibayarkan = $total_pokok + (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran);
                        $data->total_simpanan = 0; // karena belum ada data sebelumnya
                        $data->pokok_tunggakan = $nilai_pinjaman - ($total_pokok + (intval(str_replace('.', '', $request->eangsuran_dibayarkan)) - $iuran));
                    }
                }
            }
        }

        $data->save();
        $jml_pinjaman = Pinjaman::where('id', $pinjaman_id)->first()->jumlah_pinjaman;
        $total_now = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('pokok');
        $last_data = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first();
        if ($total_now >= $jml_pinjaman) {
            $sisa = $total_now - $jml_pinjaman;
            Pinjaman::where('id', $pinjaman_id)->update([
                'keterangan' => 1,
                'tgl_pelunasan' => $last_data->tgl_angsuran
            ]);
            Angsuran::where('id', $last_data->id)->update([
                'total_simpanan' => $last_data->total_simpanan + $sisa,
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
        $total_now = Angsuran::where('pinjaman_id', $pinjaman_id)->sum('pokok');
        $last_data = Angsuran::where('pinjaman_id', $pinjaman_id)->latest()->first();
        if(Angsuran::where('pinjaman_id', $pinjaman_id)->count() > 0){
            if ($total_now >=  $jml_pinjaman) {
                $sisa = $total_now - $jml_pinjaman;
                Pinjaman::where('id', $pinjaman_id)->update([
                    'keterangan' => 1,
                    'tgl_pelunasan' => $last_data->tgl_angsuran
                ]);
                Angsuran::where('id', $last_data->id)->update([
                    'total_simpanan' => $last_data->total_simpanan + $sisa,
                ]);
            } else {
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
