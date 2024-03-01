<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelompok;
use App\Models\Angsuran;
use App\Models\PejabatBumdes;
use App\Models\Peminjam;
use App\Models\Pinjaman;
use App\Models\PinjamanAnggota;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\User; // Adjust the namespace as per your application
use Carbon\Carbon;
use Riskihajar\Terbilang\Facades\Terbilang;
use PhpOffice\PhpWord\Settings;
use Alert;

Settings::setOutputEscapingEnabled(true);


class CetakDokumen extends Controller
{
    public function beritaAcaraPencairan(Request $request){
        Carbon::setLocale('id');
        try{
            $id_peminjam = $request->id_peminjam;
            $id_pinjaman = $request->id_pinjaman;
            $id_angsuran = $request->id_angsuran;
            $tgl_cair =  Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_pencairan);
            $thn_cair = $tgl_cair->format('Y');
            $terbilang_thn_cair = Terbilang::make($tgl_cair->format('Y'));
            $bln_cair = $tgl_cair->format('m');
            $terbilang_bln_cair = Terbilang::make($tgl_cair->format('m'));
            $hr_cair = $tgl_cair->day;
            $terbilang_hr_cair = Terbilang::make($tgl_cair->day);

            $hrname_cair = $tgl_cair->isoFormat('dddd');

            $jml_pinjaman = number_format(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman, 2, ',', '.');
            $jml_pokok = number_format(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pokok, 2, ',', '.');
            $jml_iuran = number_format(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_iuran, 2, ',', '.');
            $jml_angsuran = number_format(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_angsuran, 2, ',', '.');

            $terbilang = Terbilang::make(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman);
            $nama_kelompok = Peminjam::where('id', $id_peminjam)->first()->nama;
            if(PejabatBumdes::where('jabatan_id', 1)->count() == 0){
                $ketua_bumdes = 'Belum Diatur';
            }else{
                $ketua_bumdes = PejabatBumdes::where('jabatan_id', 1)->first()->user->name;
            }
            if(PejabatBumdes::where('jabatan_id', 2)->count() == 0){
                $bendahara_bumdes = 'Belum Diatur';
            }else{
                $bendahara_bumdes = PejabatBumdes::where('jabatan_id', 2)->first()->user->name;
            }
            $no_hp = Peminjam::where('id', $id_peminjam)->first()->noHP;
            $periode = Pinjaman::where('id', $id_pinjaman)->first()->periode_pinjaman;
            $jml_anggota = AnggotaKelompok::where('kelompok_id', $id_peminjam)->count();
            $terbilang_jml_anggota = Terbilang::make(AnggotaKelompok::where('kelompok_id', $id_peminjam)->count());
            $alamat_kelompok = Peminjam::where('id', $id_peminjam)->first()->alamat;
            $nama_dusun = Peminjam::where('id', $id_peminjam)->first()->nama_dusun;

            if(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->count() == 0){
                $nama_ketua = 'Belum Di Set';
                $usia_ketua = 'Belum Di Set';
                $pekerjaan_ketua = 'Belum Di Set';
                $alamat_ketua = 'Belum Di Set';
                $pinjaman_ketua = 'Belum Di Set';
                $jaminan_ketua = 'Belum Di Set';
                $nj_ketua = 'Belum Di Set';
            }elseif(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->count() > 0){
                $nama_ketua = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->nama;
                $usia_ketua = Carbon::parse(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->tgl_lahir)->diffInYears(Carbon::now());
                $pekerjaan_ketua = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->pekerjaan;
                $alamat_ketua = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->alamat;
                $pinjaman_ketua = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->id)->first()->jumlah_pinjaman, 2, ',', '.');
                $jaminan_ketua = PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->id)->first()->jaminan;
                $nj_ketua = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->id)->first()->nilai_jaminan, 2, ',', '.');
            }
            if(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->count() == 0){
                $nama_bendahara = 'Belum Di Set';
                $usia_bendahara = 'Belum Di Set';
                $pekerjaan_bendahara = 'Belum Di Set';
                $alamat_bendahara = 'Belum Di Set';
                $pinjaman_bendahara = 'Belum Di Set';
                $jaminan_bendahara = 'Belum Di Set';
                $nj_bendahara = 'Belum Di Set';
            }elseif(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->count() > 0){
                $nama_bendahara = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->nama;
                $usia_bendahara = Carbon::parse(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->tgl_lahir)->diffInYears(Carbon::now());
                $pekerjaan_bendahara = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->pekerjaan;
                $alamat_bendahara = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->alamat;
                $pinjaman_bendahara = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->id)->first()->jumlah_pinjaman, 2, ',', '.');
                $jaminan_bendahara = PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->id)->first()->jaminan;
                $nj_bendahara = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->id)->first()->nilai_jaminan, 2, ',', '.');
            }
            if(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->count() == 0){
                $nama_sekretaris = 'Belum Di Set';
                $usia_sekretaris = 'Belum Di Set';
                $pekerjaan_sekretaris = 'Belum Di Set';
                $alamat_sekretaris = 'Belum Di Set';
                $pinjaman_sekretaris = 'Belum Di Set';
                $jaminan_sekretaris = 'Belum Di Set';
                $nj_sekretaris = 'Belum Di Set';
            }elseif(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->count() > 0){
                $nama_sekretaris = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->nama;
                $usia_sekretaris = Carbon::parse(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->tgl_lahir)->diffInYears(Carbon::now());
                $pekerjaan_sekretaris = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->pekerjaan;
                $alamat_sekretaris = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->alamat;
                $pinjaman_sekretaris = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->id)->first()->jumlah_pinjaman, 2, ',', '.');
                $jaminan_sekretaris = PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->id)->first()->jaminan;
                $nj_sekretaris = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->id)->first()->nilai_jaminan, 2, ',', '.');
            }
            if(PejabatBumdes::where('jabatan_id', 5)->count() == 0){
                $kepala_desa = 'Belum Di Set';
            }elseif(PejabatBumdes::where('jabatan_id', 5)->count() > 0){
                $kepala_desa = PejabatBumdes::where('jabatan_id', 5)->first()->user->name;
            }

            $allAnggotas = AnggotaKelompok::where('kelompok_id', $id_peminjam)->get();
            $values = [];
            foreach ($allAnggotas as $index => $anggota) {
                // Fetching the data related to $anggota
                $id_peminjam = $request->id_peminjam;
                $orderedAnggota = AnggotaKelompok::where('kelompok_id', $id_peminjam)->orderBy('created_at')->pluck('id')->toArray();
                // Building the array structure
                $values[] = [
                    'urutan' => array_search($anggota->id, $orderedAnggota) + 1,
                    'urutan1' => array_search($anggota->id, $orderedAnggota) + 1,
                    'nama_anggota' => $anggota->nama,
                    'alamat_anggota' => $anggota->alamat,
                    'pinjaman_agg' => number_format(PinjamanAnggota::where('anggota_id', $anggota->id)->first()->jumlah_pinjaman, 2, ',', '.'),
                    'pokok_agg' => number_format(PinjamanAnggota::where('anggota_id', $anggota->id)->first()->pokok, 2, ',', '.'),
                    'iuran_agg' => number_format(PinjamanAnggota::where('anggota_id', $anggota->id)->first()->iuran, 2, ',', '.'),
                    'angsuran_agg' => number_format(PinjamanAnggota::where('anggota_id', $anggota->id)->first()->nilai_angsuran, 2, ',', '.'),
                ];
            }
            $templateProcessor = new TemplateProcessor(storage_path('app/kuitansi-cair.docx'));
            $templateProcessor->cloneRowAndSetValues('urutan', $values);
            $templateProcessor->cloneRowAndSetValues('urutan1', $values);

            $anggotas = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 4)->get();
            $values = [];
            foreach ($anggotas as $index => $anggota) {
                // Fetching the data related to $anggota
                $id_peminjam = $request->id_peminjam;
                $orderedAnggota = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 4)->orderBy('created_at')->pluck('id')->toArray();

                // Building the array structure
                $values[] = [
                    'urutan2' => array_search($anggota->id, $orderedAnggota) + 4,
                    'nama_anggota' => $anggota->nama,
                    'alamat_anggota' => $anggota->alamat,
                ];
            }
            $templateProcessor->cloneRowAndSetValues('urutan2', $values);

            // start setting values
            $templateProcessor->setValue('thn_cair', $thn_cair);
            $templateProcessor->setValue('bln_cair', $bln_cair);
            $templateProcessor->setValue('hr_cair', $hr_cair);
            $templateProcessor->setValue('id_pinjaman', $id_pinjaman);
            $templateProcessor->setValue('jml_pinjaman', $jml_pinjaman);
            $templateProcessor->setValue('jml_pokok', $jml_pokok);
            $templateProcessor->setValue('jml_iuran', $jml_iuran);
            $templateProcessor->setValue('jml_angsuran', $jml_angsuran);
            $templateProcessor->setValue('terbilang', $terbilang);
            $templateProcessor->setValue('nama_kelompok', $nama_kelompok);
            $templateProcessor->setValue('tgl_cair', $tgl_cair->isoFormat('D MMMM Y'));
            $templateProcessor->setValue('ketua_bumdes', $ketua_bumdes);
            $templateProcessor->setValue('bendahara_bumdes', $bendahara_bumdes);
            $templateProcessor->setValue('jml_anggota', $jml_anggota);
            $templateProcessor->setValue('terbilang_jml_anggota', $terbilang_jml_anggota);
            $templateProcessor->setValue('alamat_kelompok', $alamat_kelompok);
            $templateProcessor->setValue('nama_sekretaris', $nama_sekretaris);
            $templateProcessor->setValue('alamat_sekretaris', $alamat_sekretaris);
            $templateProcessor->setValue('nama_ketua', $nama_ketua);
            $templateProcessor->setValue('alamat_ketua', $alamat_ketua);
            $templateProcessor->setValue('usia_ketua', $usia_ketua);
            $templateProcessor->setValue('pekerjaan_ketua', $pekerjaan_ketua);
            $templateProcessor->setValue('kepala_desa', $kepala_desa);
            $templateProcessor->setValue('hrname_cair', $hrname_cair);
            $templateProcessor->setValue('terbilang_hr_cair', $terbilang_hr_cair);
            $templateProcessor->setValue('terbilang_bln_cair', $terbilang_bln_cair);
            $templateProcessor->setValue('terbilang_thn_cair', $terbilang_thn_cair);
            $templateProcessor->setValue('nama_bendahara', $nama_bendahara);
            $templateProcessor->setValue('usia_bendahara', $usia_bendahara);
            $templateProcessor->setValue('pekerjaan_bendahara', $pekerjaan_bendahara);
            $templateProcessor->setValue('alamat_bendahara', $alamat_bendahara);
            // $templateProcessor->setValue('urutan', $urutan);
            // Save the document to a temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'Kuitansi-'. $nama_kelompok);
            $templateProcessor->saveAs($tempFile);

            // Download the document
            return response()->download($tempFile, 'Kuitansi-'. $nama_kelompok . '.docx')->deleteFileAfterSend();

        }catch(\Throwable $e){
            $kelompok = $request->id_peminjam;
            Alert::error('Data Tidak Lengkap', $e->getMessage());
            return redirect()->route('detail-kelompok.index', ['kelompok' => $kelompok]);
        }
    }

    public function suratPinjaman(Request $request){
        Carbon::setLocale('id');
        try{
            $id_peminjam = $request->id_peminjam;
            $id_pinjaman = $request->id_pinjaman;
            $id_angsuran = $request->id_angsuran;

            $nama_peminjam = Peminjam::where('id', $id_peminjam)->first()->nama;
            $alamat_peminjam = Peminjam::where('id', $id_peminjam)->first()->alamat;
            $jml_pinjaman = number_format(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman, 2, ',', '.');
            $terbilang = Terbilang::make(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman);
            $terbilang_jangka = Terbilang::make(Pinjaman::where('id', $id_pinjaman)->first()->jangka_waktu);
            $jatuh_tempo =  Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_jatuh_tempo);
            $tgl_cair =  Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_pencairan);
            if(PejabatBumdes::where('jabatan_id', 1)->count() == 0){
                $ketua_bumdes = 'Belum Diatur';
            }else{
                $ketua_bumdes = PejabatBumdes::where('jabatan_id', 1)->first()->user->name;
            }
            if(PejabatBumdes::where('jabatan_id', 2)->count() == 0){
                $bendahara_bumdes = 'Belum Diatur';
            }else{
                $bendahara_bumdes = PejabatBumdes::where('jabatan_id', 2)->first()->user->name;
            }
            $templateProcessor = new TemplateProcessor(storage_path('app/surat-pinjaman.docx'));

            // start setting values
            $templateProcessor->setValue('nama_peminjam', $nama_peminjam);
            $templateProcessor->setValue('alamat_peminjam', $alamat_peminjam);
            $templateProcessor->setValue('jml_pinjaman', $jml_pinjaman);
            $templateProcessor->setValue('terbilang', $terbilang);
            $templateProcessor->setValue('terbilang_jangka', $terbilang_jangka);
            $templateProcessor->setValue('jatuh_tempo', $jatuh_tempo->isoFormat('D MMMM Y'));
            $templateProcessor->setValue('tgl_cair', $tgl_cair->isoFormat('D MMMM Y'));
            $templateProcessor->setValue('ketua_bumdes', $ketua_bumdes);
            // $templateProcessor->setValue('urutan', $urutan);
            // Save the document to a temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'Surat-Pinjaman-'. $nama_peminjam);
            $templateProcessor->saveAs($tempFile);

            // Download the document
            return response()->download($tempFile, 'Surat-Pinjaman-'. $nama_peminjam . '.docx')->deleteFileAfterSend();

        }catch(\Throwable $e){
            $single = $request->id_peminjam;
            Alert::error('Data Tidak Lengkap', $e->getMessage());
            return redirect()->route('detail-single.index', ['single' => $single]);
        }
    }

    public function proposalPinjaman(Request $request){
        try{
            $id_peminjam = $request->id_peminjam;
            $id_pinjaman = $request->id_pinjaman;
            $id_angsuran = $request->id_angsuran;

            $nama_kelompok = Peminjam::where('id', $id_peminjam)->first()->nama;
            $alamat_kelompok = Peminjam::where('id', $id_peminjam)->first()->alamat;
            $nama_dusun = Peminjam::where('id', $id_peminjam)->first()->nama_dusun;

            if(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->count() == 0){
                $nama_ketua = 'Belum Di Set';
                $usia_ketua = 'Belum Di Set';
                $pekerjaan_ketua = 'Belum Di Set';
                $alamat_ketua = 'Belum Di Set';
                $pinjaman_ketua = 'Belum Di Set';
                $jaminan_ketua = 'Belum Di Set';
                $nj_ketua = 'Belum Di Set';
            }elseif(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->count() > 0){
                $nama_ketua = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->nama;
                $usia_ketua = Carbon::parse(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->tgl_lahir)->diffInYears(Carbon::now());
                $pekerjaan_ketua = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->pekerjaan;
                $alamat_ketua = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->alamat;
                $pinjaman_ketua = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->id)->first()->jumlah_pinjaman, 2, ',', '.');
                $jaminan_ketua = PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->id)->first()->jaminan;
                $nj_ketua = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->id)->first()->nilai_jaminan, 2, ',', '.');
            }
            if(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->count() == 0){
                $nama_bendahara = 'Belum Di Set';
                $usia_bendahara = 'Belum Di Set';
                $pekerjaan_bendahara = 'Belum Di Set';
                $alamat_bendahara = 'Belum Di Set';
                $pinjaman_bendahara = 'Belum Di Set';
                $jaminan_bendahara = 'Belum Di Set';
                $nj_bendahara = 'Belum Di Set';
            }elseif(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->count() > 0){
                $nama_bendahara = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->nama;
                $usia_bendahara = Carbon::parse(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->tgl_lahir)->diffInYears(Carbon::now());
                $pekerjaan_bendahara = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->pekerjaan;
                $alamat_bendahara = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->alamat;
                $pinjaman_bendahara = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->id)->first()->jumlah_pinjaman, 2, ',', '.');
                $jaminan_bendahara = PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->id)->first()->jaminan;
                $nj_bendahara = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 2)->first()->id)->first()->nilai_jaminan, 2, ',', '.');
            }
            if(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->count() == 0){
                $nama_sekretaris = 'Belum Di Set';
                $usia_sekretaris = 'Belum Di Set';
                $pekerjaan_sekretaris = 'Belum Di Set';
                $alamat_sekretaris = 'Belum Di Set';
                $pinjaman_sekretaris = 'Belum Di Set';
                $jaminan_sekretaris = 'Belum Di Set';
                $nj_sekretaris = 'Belum Di Set';
            }elseif(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->count() > 0){
                $nama_sekretaris = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->nama;
                $usia_sekretaris = Carbon::parse(AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->tgl_lahir)->diffInYears(Carbon::now());
                $pekerjaan_sekretaris = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->pekerjaan;
                $alamat_sekretaris = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->alamat;
                $pinjaman_sekretaris = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->id)->first()->jumlah_pinjaman, 2, ',', '.');
                $jaminan_sekretaris = PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->id)->first()->jaminan;
                $nj_sekretaris = number_format(PinjamanAnggota::where('anggota_id', AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 3)->first()->id)->first()->nilai_jaminan, 2, ',', '.');
            }
            if(PejabatBumdes::where('jabatan_id', 5)->count() == 0){
                $kepala_desa = 'Belum Di Set';
            }elseif(PejabatBumdes::where('jabatan_id', 5)->count() > 0){
                $kepala_desa = PejabatBumdes::where('jabatan_id', 5)->first()->user->name;
            }
            $no_hp = Peminjam::where('id', $id_peminjam)->first()->noHP;
            $periode = Pinjaman::where('id', $id_pinjaman)->first()->periode_pinjaman;
            $jml_pinjaman = number_format(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman, 2, ',', '.');
            $terbilang = Terbilang::make(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman);
            $jml_anggota = AnggotaKelompok::where('kelompok_id', $id_peminjam)->count();

            // $orderedAnggota = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 4)->orderBy('created_at')->pluck('id')->toArray();
            // Find the index of the desired ID in the array
            // $urutan = array_search($id_angsuran, $orderedAnggota) + 1;

            $anggotas = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 4)->get();
            $values = [];
            foreach ($anggotas as $index => $anggota) {
                // Fetching the data related to $anggota
                $id_peminjam = $request->id_peminjam;
                $orderedAnggota = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 4)->orderBy('created_at')->pluck('id')->toArray();

                // Building the array structure
                $values[] = [
                    'urutan' => array_search($anggota->id, $orderedAnggota) + 4,
                    'urutan1' => array_search($anggota->id, $orderedAnggota) + 4,
                    'urutan2' => array_search($anggota->id, $orderedAnggota) + 4,
                    'id_kelompok' => $id_peminjam,
                    'periode' => $periode,
                    'nama_anggota' => $anggota->nama,
                    'alamat_anggota' => $anggota->alamat,
                     // Adjust this based on your actual attribute names
                    'usia_anggota' => Carbon::parse($anggota->tgl_lahir)->diffInYears(Carbon::now()) . ' tahun',
                    'pekerjaan_anggota' => $anggota->pekerjaan, // Adjust this based on your actual attribute names
                    'pinjaman_angg' => number_format(PinjamanAnggota::where('anggota_id', $anggota->id)->first()->jumlah_pinjaman, 2, ',', '.'),
                    'jaminan_anggota' => PinjamanAnggota::where('anggota_id', $anggota->id)->first()->jaminan,
                    'nj_anggota' => number_format(PinjamanAnggota::where('anggota_id', $anggota->id)->first()->nilai_jaminan, 2, ',', '.')
                ];
            }
            // Load the Word document template
            $templateProcessor = new TemplateProcessor(storage_path('app/proposal-pinjaman.docx'));
            // Replace placeholders with actual data
            $templateProcessor->cloneRowAndSetValues('urutan', $values);
            $templateProcessor->cloneRowAndSetValues('urutan1', $values);
            $templateProcessor->cloneRowAndSetValues('urutan2', $values);

            $templateProcessor->setValue('nama_kelompok', $nama_kelompok);
            $templateProcessor->setValue('alamat_kelompok', $alamat_kelompok);

            $templateProcessor->setValue('nama_ketua', $nama_ketua);
            $templateProcessor->setValue('usia_ketua', $usia_ketua);
            $templateProcessor->setValue('pekerjaan_ketua', $pekerjaan_ketua);
            $templateProcessor->setValue('alamat_ketua', $alamat_ketua);
            $templateProcessor->setValue('pinjaman_ketua', $pinjaman_ketua);
            $templateProcessor->setValue('jaminan_ketua', $jaminan_ketua);
            $templateProcessor->setValue('nj_ketua', $nj_ketua);

            $templateProcessor->setValue('nama_sekretaris', $nama_sekretaris);
            $templateProcessor->setValue('usia_sekretaris', $usia_sekretaris);
            $templateProcessor->setValue('pekerjaan_sekretaris', $pekerjaan_sekretaris);
            $templateProcessor->setValue('alamat_sekretaris', $alamat_sekretaris);
            $templateProcessor->setValue('pinjaman_sekre', $pinjaman_sekretaris);
            $templateProcessor->setValue('jaminan_sekretaris', $jaminan_sekretaris);
            $templateProcessor->setValue('nj_sekretaris', $nj_sekretaris);

            $templateProcessor->setValue('nama_bendahara', $nama_bendahara);
            $templateProcessor->setValue('usia_bendahara', $usia_bendahara);
            $templateProcessor->setValue('pekerjaan_bendahara', $pekerjaan_bendahara);
            $templateProcessor->setValue('alamat_bendahara', $alamat_bendahara);
            $templateProcessor->setValue('pinjaman_bend', $pinjaman_bendahara);
            $templateProcessor->setValue('jaminan_bendahara', $jaminan_bendahara);
            $templateProcessor->setValue('nj_bendahara', $nj_bendahara);

            $templateProcessor->setValue('no_hp', $no_hp);
            $templateProcessor->setValue('periode', $periode);
            $templateProcessor->setValue('jml_pinjaman', $jml_pinjaman);
            $templateProcessor->setValue('id_kelompok', $id_peminjam);
            $templateProcessor->setValue('terbilang', $terbilang);
            $templateProcessor->setValue('jml_anggota', $jml_anggota);
            $templateProcessor->setValue('kepala_desa', $kepala_desa);
            $templateProcessor->setValue('nama_dusun', $nama_dusun);
            // $templateProcessor->setValue('urutan', $urutan);
            // Save the document to a temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'Proposal-Pinjaman-'. $nama_kelompok);
            $templateProcessor->saveAs($tempFile);

            // Download the document
            return response()->download($tempFile, 'Proposal-Pinjaman-'. $nama_kelompok . '.docx')->deleteFileAfterSend();

        }catch(\Throwable $e){
            $kelompok = $request->id_peminjam;
            Alert::error('Data Tidak Lengkap', $e->getMessage());
            return redirect()->route('detail-kelompok.index', ['kelompok' => $kelompok]);
        }
    }

    public function kuitansiAngsuranKelompok(Request $request){
        try{
            // Fetch data from the database
            $id_peminjam = $request->id_peminjam;
            $id_pinjaman = $request->id_pinjaman;
            $id_angsuran = $request->id_angsuran;
            $angsuran_ke = Angsuran::where('id', $id_angsuran)->first()->angsuran_ke;

            $tgl_angsuran = Carbon::parse(Angsuran::where('id', $id_angsuran)->first()->tgl_angsuran);
            $thn_angs = $tgl_angsuran->format('Y');
            $bln_angs = $tgl_angsuran->format('m');
            $tgl_angs = $tgl_angsuran->day;
            $kode_kelompok = $id_peminjam;
            $nama_kelompok = Peminjam::where('id', $id_peminjam)->first()->nama;
            $jml_angsuran = number_format(Angsuran::where('id', $id_angsuran)->first()->angsuran_dibayarkan, 2, ',', '.');
            $terbilang = Terbilang::make(Angsuran::where('id', $id_angsuran)->first()->angsuran_dibayarkan);
            $orderedAngsuran = Angsuran::orderBy('tgl_angsuran')->pluck('id')->toArray();
            // Find the index of the desired ID in the array
            $urutan = array_search($id_angsuran, $orderedAngsuran) + 1;
            $nilai_pokok =  number_format(Angsuran::where('id', $id_angsuran)->first()->pokok, 2, ',', '.');
            $nilai_iuran = number_format(Angsuran::where('id', $id_angsuran)->first()->iuran, 2, ',', '.');
            $nama_ketua = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->nama;
            $nama_bendahara = PejabatBumdes::where('jabatan_id', 2)->first()->user->name;
            $tanggal_angsuran = $tgl_angsuran->format('d, F Y');
            $tgl_lunas = Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan;

            // Load the Word document template
            $templateProcessor = new TemplateProcessor(storage_path('app/kuitansi-spp-kelompok.docx'));

            // Replace placeholders with actual data
            $templateProcessor->setValue('thn_angs', $thn_angs);
            $templateProcessor->setValue('bln_angs', $bln_angs);
            $templateProcessor->setValue('tgl_angs', $tgl_angs);
            $templateProcessor->setValue('id_peminjam', $id_peminjam);
            $templateProcessor->setValue('id_pinjaman', $id_pinjaman);
            $templateProcessor->setValue('kode_kelompok', $kode_kelompok);
            $templateProcessor->setValue('nama_kelompok', $nama_kelompok);
            $templateProcessor->setValue('jumlah_angsuran', $jml_angsuran);
            $templateProcessor->setValue('terbilang', $terbilang);
            $templateProcessor->setValue('urutan', $angsuran_ke);
            $templateProcessor->setValue('nilai_pokok', $nilai_pokok);
            $templateProcessor->setValue('nilai_iuran', $nilai_iuran);
            $templateProcessor->setValue('tgl_angsuran', Carbon::parse(Angsuran::where('id', $id_angsuran)->first()->tgl_angsuran)->isoFormat('D MMMM Y'));
            $templateProcessor->setValue('nama_ketua', $nama_ketua);
            $templateProcessor->setValue('nama_bendahara', $nama_bendahara);
            $templateProcessor->setValue('pokok_byr', $nilai_pokok);
            $templateProcessor->setValue('angs_bayar', $jml_angsuran);
            $templateProcessor->setValue('nilai_iuran', $nilai_iuran);
            $templateProcessor->setValue('sum_an', $angsuran_ke);
            $templateProcessor->setValue('tgl_lunas', $tgl_lunas != null ? Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan)->isoFormat('D MMMM Y') : 'Belum Lunas');

            // Save the document to a temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'Kuitansi-SPP-'. $tgl_angsuran);
            $templateProcessor->saveAs($tempFile);
            // Download the document
            return response()->download($tempFile, 'Kuitansi-SPP-'. $tgl_angsuran . '.docx')->deleteFileAfterSend();
        }catch(\Throwable $e){
            $kelompok = $request->id_peminjam;
            Alert::error('Data Tidak Lengkap', $e->getMessage());
            return redirect()->back();
        }
    }

    public function kuitansiAngsuranSingle(Request $request){
        try{
            // Fetch data from the database
            $id_peminjam = $request->id_peminjam;
            $id_pinjaman = $request->id_pinjaman;
            $id_angsuran = $request->id_angsuran;
            $angsuran_ke = Angsuran::where('id', $id_angsuran)->first()->angsuran_ke;

            $tgl_angsuran = Carbon::parse(Angsuran::where('id', $id_angsuran)->first()->tgl_angsuran);
            $thn_angs = $tgl_angsuran->format('Y');
            $bln_angs = $tgl_angsuran->format('m');
            $tgl_angs = $tgl_angsuran->day;
            $kode_peminjam = $id_peminjam;
            $nama_peminjam = Peminjam::where('id', $id_peminjam)->first()->nama;
            $jml_angsuran = number_format(Angsuran::where('id', $id_angsuran)->first()->angsuran_dibayarkan, 2, ',', '.');
            $terbilang = Terbilang::make(Angsuran::where('id', $id_angsuran)->first()->angsuran_dibayarkan);
            $orderedAngsuran = Angsuran::orderBy('tgl_angsuran')->pluck('id')->toArray();
            // Find the index of the desired ID in the array
            $urutan = array_search($id_angsuran, $orderedAngsuran) + 1;
            $nilai_pokok =  number_format(Angsuran::where('id', $id_angsuran)->first()->pokok, 2, ',', '.');
            $nilai_iuran = number_format(Angsuran::where('id', $id_angsuran)->first()->iuran, 2, ',', '.');
            $nama_bendahara = PejabatBumdes::where('jabatan_id', 2)->first()->user->name;
            $tanggal_angsuran = $tgl_angsuran->format('d, F Y');
            $tgl_lunas = Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan;

            // Load the Word document template
            $templateProcessor = new TemplateProcessor(storage_path('app/kuitansi-spp-single.docx'));

            // Replace placeholders with actual data
            $templateProcessor->setValue('thn_angs', $thn_angs);
            $templateProcessor->setValue('bln_angs', $bln_angs);
            $templateProcessor->setValue('tgl_angs', $tgl_angs);
            $templateProcessor->setValue('id_peminjam', $id_peminjam);
            $templateProcessor->setValue('id_pinjaman', $id_pinjaman);
            $templateProcessor->setValue('kode_peminjam', $kode_peminjam);
            $templateProcessor->setValue('nama_peminjam', $nama_peminjam);
            $templateProcessor->setValue('jumlah_angsuran', $jml_angsuran);
            $templateProcessor->setValue('terbilang', $terbilang);
            $templateProcessor->setValue('urutan', $angsuran_ke);
            $templateProcessor->setValue('nilai_pokok', $nilai_pokok);
            $templateProcessor->setValue('nilai_iuran', $nilai_iuran);
            $templateProcessor->setValue('tgl_angsuran', Carbon::parse(Angsuran::where('id', $id_angsuran)->first()->tgl_angsuran)->isoFormat('D MMMM Y'));
            $templateProcessor->setValue('nama_bendahara', $nama_bendahara);
            $templateProcessor->setValue('pokok_byr', $nilai_pokok);
            $templateProcessor->setValue('angs_bayar', $jml_angsuran);
            $templateProcessor->setValue('nilai_iuran', $nilai_iuran);
            $templateProcessor->setValue('sum_an', $angsuran_ke);
            $templateProcessor->setValue('tgl_lunas', $tgl_lunas != null ? Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan)->isoFormat('D MMMM Y') : 'Belum Lunas');

            // Save the document to a temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'Kuitansi-SPP-'. $tgl_angsuran);
            $templateProcessor->saveAs($tempFile);
            // Download the document
            return response()->download($tempFile, 'Kuitansi-SPP-'. $tgl_angsuran . '.docx')->deleteFileAfterSend();
        }catch(\Throwable $e){
            $kelompok = $request->id_peminjam;
            Alert::error('Data Tidak Lengkap', $e->getMessage());
            return redirect()->back();
        }
    }

    public function dokumenPinjaman(Request $request){
        // Fetch data from the database
        $users = User::all(); // Example: Fetching all users

        // Create a new PHPWord object
        $phpWord = new PhpWord();

        // Add a section to the document
        $section = $phpWord->addSection();

        // Add content to the section (example: table of users)
        $table = $section->addTable();
        foreach ($users as $user) {
            $table->addRow();
            $table->addCell()->addText($user->name);
            $table->addCell()->addText($user->email);
        }

        // Save the document to a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'phpword');
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        // Download the document
        return response()->download($tempFile, 'document.docx')->deleteFileAfterSend();
    }
    public function kuitansiLunasKelompok(Request $request){

        try{
            // Fetch data from the database
            $id_peminjam = $request->id_peminjam;
            $id_pinjaman = $request->id_pinjaman;

           //  $angs_id = Angsuran::where('pinjaman_id', $id_pinjaman)->orderBy('tgl_angsuran', 'DESC')->first()->id;
            $last_angs = Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan);
            $thn_angs = $last_angs->format('Y');
            $nama_kelompok = Peminjam::where('id', $id_peminjam)->first()->nama;
            $jml_pinjaman = number_format(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman, 2, ',', '.');
            $terbilang = Terbilang::make(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman);
            $tgl_lunas = $last_angs->format('d, F Y');
            $ketua_kelompok = AnggotaKelompok::where('kelompok_id', $id_peminjam)->where('jabatan_id', 1)->first()->nama;
            $nama_bendahara = PejabatBumdes::where('jabatan_id', 2)->first()->user->name;
            $ketua_bumdes = PejabatBumdes::where('jabatan_id', 1)->first()->user->name;
            // Load the Word document template
            $templateProcessor = new TemplateProcessor(storage_path('app/kuitansi-lunas-kelompok.docx'));

            // Replace placeholders with actual data
            $templateProcessor->setValue('thn_angs', $thn_angs);
            $templateProcessor->setValue('nama_kelompok', $nama_kelompok);
            $templateProcessor->setValue('jml_pinjaman', $jml_pinjaman);
            $templateProcessor->setValue('id_pinjaman', $id_pinjaman);
            $templateProcessor->setValue('terbilang', $terbilang);
            $templateProcessor->setValue('tgl_lunas', $tgl_lunas != null ? Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan)->isoFormat('D MMMM Y') : 'Belum Lunas');
            $templateProcessor->setValue('ketua_bumdes', $ketua_bumdes);
            $templateProcessor->setValue('nama_bendahara', $nama_bendahara);
            $templateProcessor->setValue('ketua_kelompok', $ketua_kelompok);

            // Save the document to a temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'Kuitansi-Lunas-'.$nama_kelompok. '-'.Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan);
            $templateProcessor->saveAs($tempFile);
            // Download the document
            return response()->download($tempFile, 'Kuitansi-Lunas-'.$nama_kelompok. '-'.Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan . '.docx')->deleteFileAfterSend();
        }catch(\Throwable $e){
            $kelompok = $request->id_peminjam;
            Alert::error('Data Tidak Lengkap', $e->getMessage());
            return redirect()->back();
        }
    }

    public function kuitansiLunasSingle(Request $request){

        try{
            // Fetch data from the database
            $id_peminjam = $request->id_peminjam;
            $id_pinjaman = $request->id_pinjaman;

           //  $angs_id = Angsuran::where('pinjaman_id', $id_pinjaman)->orderBy('tgl_angsuran', 'DESC')->first()->id;
            $last_angs = Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan);
            $thn_angs = $last_angs->format('Y');
            $nama_peminjam = Peminjam::where('id', $id_peminjam)->first()->nama;
            $jml_pinjaman = number_format(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman, 2, ',', '.');
            $terbilang = Terbilang::make(Pinjaman::where('id', $id_pinjaman)->first()->jumlah_pinjaman);
            $tgl_lunas = $last_angs->format('d, F Y');
            $nama_bendahara = PejabatBumdes::where('jabatan_id', 2)->first()->user->name;
            $ketua_bumdes = PejabatBumdes::where('jabatan_id', 1)->first()->user->name;
            // Load the Word document template
            $templateProcessor = new TemplateProcessor(storage_path('app/kuitansi-lunas-single.docx'));

            // Replace placeholders with actual data
            $templateProcessor->setValue('thn_angs', $thn_angs);
            $templateProcessor->setValue('id_pinjaman', $id_pinjaman);
            $templateProcessor->setValue('nama_peminjam', $nama_peminjam);
            $templateProcessor->setValue('jml_pinjaman', $jml_pinjaman);
            $templateProcessor->setValue('terbilang', $terbilang);
            $templateProcessor->setValue('tgl_lunas', $tgl_lunas != null ? Carbon::parse(Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan)->isoFormat('D MMMM Y') : 'Belum Lunas');
            $templateProcessor->setValue('ketua_bumdes', $ketua_bumdes);
            $templateProcessor->setValue('nama_bendahara', $nama_bendahara);

            // Save the document to a temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'Kuitansi-Lunas-'.$nama_peminjam. '-'.Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan);
            $templateProcessor->saveAs($tempFile);
            // Download the document
            return response()->download($tempFile, 'Kuitansi-Lunas-'.$nama_peminjam. '-'.Pinjaman::where('id', $id_pinjaman)->first()->tgl_pelunasan . '.docx')->deleteFileAfterSend();
        }catch(\Throwable $e){
            $kelompok = $request->id_peminjam;
            Alert::error('Data Tidak Lengkap', $e->getMessage());
            return redirect()->back();
        }
    }
}
