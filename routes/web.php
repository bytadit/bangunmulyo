<?php

use App\Http\Controllers\AnggotaKelompokController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\AngsuranKelompokController;
use App\Http\Controllers\AngsuranSingleController;
use App\Http\Controllers\CetakDokumen;
use App\Http\Controllers\ChartDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailSingleController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PejabatBumdesController;
use App\Http\Controllers\PeminjamKelompokController;
use App\Http\Controllers\PeminjamSingleController;
use App\Http\Controllers\PinjamanAnggotaController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PinjamanKelompokController;
use App\Http\Controllers\PinjamanSingleController;
use App\Http\Controllers\ReferensiJabatanController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//
Route::get('/', function (){
    return redirect('/beranda');
});

Route::get('/angsuran-kelompok', [AngsuranKelompokController::class, 'daftarPeminjam'])->name('angsuran-kelompok.daftar-peminjam');
Route::get('/angsuran-single', [AngsuranSingleController::class, 'daftarPeminjam'])->name('angsuran-single.daftar-peminjam');
Route::get('/angsuran-kelompok/{kelompok}/pinjaman-kelompok', [AngsuranKelompokController::class, 'daftarPinjaman'])->name('angsuran-kelompok.daftar-pinjaman');
Route::get('/angsuran-single/{single}/pinjaman-single', [AngsuranSingleController::class, 'daftarPinjaman'])->name('angsuran-single.daftar-pinjaman');

// export database
Route::get('/cadangkan-data', [DatabaseController::class, 'DBView'])->name('database.index');
Route::post('/export-db', [DatabaseController::class, 'exportDB'])->name('exportdb.post');
Route::post('/import-db', [DatabaseController::class, 'importDB'])->name('importdb.post');

// get data chart
Route::get('/api/data/iuran', [ChartDataController::class, 'getIuranData'])->name('get-data-iuran)');
Route::get('/api/data/iuran-range', [ChartDataController::class, 'getIuranDataRange'])->name('get-data-iuran-range)');

// ekspor sheet
Route::get('/anggota/export_excel/{kelompok}', [AnggotaKelompokController::class, 'exportAnggota'])->name('export-anggota');
Route::get('/inventaris/export_excel', [InventarisController::class, 'exportInventaris'])->name('export-inventaris');

// import sheet
Route::post('/anggota/import_excel/{kelompok}', [AnggotaKelompokController::class, 'importAnggota'])->name('import-anggota');

// cetak dokumen
Route::post('/cetak-proposal', [CetakDokumen::class, 'proposalPinjaman'])->name('cetak.proposal');
Route::post('/cetak-ba-pencairan', [CetakDokumen::class, 'beritaAcaraPencairan'])->name('cetak.ba-pencairan');
Route::post('/cetak-surat-pinjaman', [CetakDokumen::class, 'suratPinjaman'])->name('cetak.surat-pinjaman');

Route::post('/dokumen-pinjaman', [CetakDokumen::class, 'dokumenPinjaman'])->name('cetak.dokumen');
Route::post('/cetak-kuitansi-angsuran-kelompok', [CetakDokumen::class, 'kuitansiAngsuranKelompok'])->name('cetak.kuitansi-angsuran-kelompok');
Route::post('/cetak-kuitansi-angsuran-single', [CetakDokumen::class, 'kuitansiAngsuranSingle'])->name('cetak.kuitansi-angsuran-single');
Route::post('/cetak-kuitansi-lunas-kelompok', [CetakDokumen::class, 'kuitansiLunasKelompok'])->name('cetak.kuitansi-lunas-kelompok');
Route::post('/cetak-kuitansi-lunas-single', [CetakDokumen::class, 'kuitansiLunasSingle'])->name('cetak.kuitansi-lunas-single');

Route::put('/peminjam-kelompok/{kelompok}/pinjaman-kelompok/{pinjaman_kelompok}/update-full', [PinjamanKelompokController::class, 'updateFull'])->name('pinjaman-kelompok.update-full');
Route::put('/peminjam-single/{single}/pinjaman-single/{pinjaman_single}/update-full', [PinjamanSingleController::class, 'updateFull'])->name('pinjaman-single.update-full');

Route::resource('/beranda', DashboardController::class);
Route::resource('/jabatan', ReferensiJabatanController::class);
Route::resource('/pejabat', PejabatBumdesController::class);
Route::resource('/setting', SettingController::class);
// Route::resource('/pinjaman', PinjamanController::class);
//
Route::resource('/peminjam-kelompok', PeminjamKelompokController::class);
Route::resource('/peminjam-kelompok/{kelompok}/detail-kelompok', AnggotaKelompokController::class);
Route::resource('/peminjam-kelompok/{kelompok}/pinjaman-kelompok', PinjamanKelompokController::class);
Route::resource('/peminjam-single', PeminjamSingleController::class);
Route::resource('/peminjam-single/{single}/detail-single', DetailSingleController::class);
Route::resource('/peminjam-single/{single}/pinjaman-single', PinjamanSingleController::class);
Route::resource('/inventaris', InventarisController::class);
Route::resource('/peminjam-kelompok/{kelompok}/pinjaman-kelompok/{pinjaman_kelompok}/pinjaman-anggota', PinjamanAnggotaController::class);

Route::resource('/angsuran-kelompok/{kelompok}/pinjaman-kelompok/{pinjaman_kelompok}/riwayat-angsuran-kelompok', AngsuranKelompokController::class);
Route::resource('/angsuran-single/{single}/pinjaman-single/{pinjaman_single}/riwayat-angsuran-single', AngsuranSingleController::class);




