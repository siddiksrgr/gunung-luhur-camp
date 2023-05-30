<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesanTiketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SewaAlatController;
use App\Http\Controllers\AlatSewaController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PesanMakanController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HargaTiketController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BeliBarangController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\CaraBayarController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\BatalTiketController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\TiketSayaController;
use App\Http\Controllers\SewaAlatTambahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RatingFeedbackController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ShiftKerjaController;
use App\Http\Controllers\JadwalPiketController;
use App\Http\Controllers\PenggantianAlatRusakController;
use App\Http\Controllers\KunjunganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    Route::get('/daftar', [AuthController::class, 'getRegister'])->name('register');
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
});
 
Route::post('/daftar', [AuthController::class, 'postRegister']);
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/', [HomeController::class, 'index']);
Route::get('/rating', [RatingFeedbackController::class, 'index']);

Route::group(['middleware' => ['auth', 'checkLevel:pengunjung']], function () {
    Route::get('/pesan_tiket', [PesanTiketController::class, 'create']);
    Route::post('/pesan_tiket/{hargatiket}', [PesanTiketController::class, 'store']);
    Route::get('/pesan_tiket/{pesanTiket}/destroy', [PesanTiketController::class, 'destroy']);
    Route::get('/pesan_tiket/{pesanTiket}/show', [PesanTiketController::class, 'showUser']);

    Route::get('/sewa_tenda', [SewaAlatController::class, 'create']);
    Route::post('/sewa_tenda/{alatsewa}', [SewaAlatController::class, 'store']);
    Route::get('/sewa_tenda/{sewaTenda}/destroy', [SewaAlatController::class, 'destroy']);
    Route::get('/sewa_tenda/{sewaTenda}/show', [SewaAlatController::class, 'show']);

    Route::get('/pesan_makan', [PesanMakanController::class, 'create']);
    Route::post('/pesan_makan/{makanan}', [PesanMakanController::class, 'store']);
    Route::get('/pesan_makan/{pesanMakan}/show', [PesanMakanController::class, 'show']);
    Route::get('/pesan_makan/{pesanMakan}/destroy', [PesanMakanController::class, 'destroy']);

    Route::get('/invoice', [InvoiceController::class, 'download']);

    Route::get('/bayar', [CaraBayarController::class, 'index']);

    Route::get('/konfirmasi/user', [KonfirmasiController::class, 'indexUser']);
    Route::get('/konfirmasi/create', [KonfirmasiController::class, 'create']);
    Route::post('/konfirmasi/{pemesanan}', [KonfirmasiController::class, 'store']);
    Route::get('/konfirmasi/{pemesanan}/showUser', [KonfirmasiController::class, 'showUser']);
    Route::get('/konfirmasi/{pemesanan}/download', [KonfirmasiController::class, 'download']);

    Route::get('/tiket_saya', [TiketSayaController::class, 'index']);
    Route::get('/download/{pemesanan}', [TiketSayaController::class, 'download']);

    Route::get('/batal_tiket/{pemesanan}', [BatalTiketController::class, 'create']);
    Route::post('/batal_tiket/{pemesanan}', [BatalTiketController::class, 'store']);
    Route::get('/batal_tiket', [BatalTiketController::class, 'indexUser']);
    Route::get('/batal_tiket/{pemesanan}/showUser', [BatalTiketController::class, 'showUser']);

    Route::get('/pemesanan_user', [PemesananController::class, 'index']);

    Route::get('/rating/create', [RatingFeedbackController::class, 'create']);
    Route::post('/rating', [RatingFeedbackController::class, 'store']);
    Route::get('/rating/edit', [RatingFeedbackController::class, 'edit']);
    Route::patch('/rating/{rating}', [RatingFeedbackController::class, 'update']);
    Route::get('/rating/hapus', [RatingFeedbackController::class, 'delete']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/profile/edit', [UserController::class, 'editPengunjung']);
    Route::patch('/profile/{user}', [UserController::class, 'updatePengunjung']);
    Route::get('/profile/editPassword/{user}', [UserController::class, 'editPassword']);
    Route::patch('/profile/editPassword/{user}', [UserController::class, 'updatePasswordPengunjung']);
});

Route::group(['middleware' => ['auth', 'checkLevel:admin']], function () {
    Route::get('/dashboardAdmin', function () {
        return view('layoutAdmin.dashboard.admin.index');
    });

    Route::get('/user/admin/{user}/edit', [UserController::class, 'editAdmin']);
    Route::patch('/user/admin/{user}/updateAdmin', [UserController::class, 'updateAdmin']);
    Route::get('/user/admin/{user}/editPasswordAdmin', [UserController::class, 'editPasswordAdmin']);
    Route::patch('/user/admin/{user}/updatePasswordAdmin', [UserController::class, 'updatePasswordAdmin']);

    Route::get('/user/pengelola/create', [UserController::class, 'createPengelola']);
    Route::post('/user/pengelola', [UserController::class, 'storePengelola']);
    Route::get('/user/pengelola/{pengelola}/destroy', [UserController::class, 'destroyPengelola']);
});

Route::group(['middleware' => ['auth', 'checkLevel:pengelola']], function () {
    Route::get('/dashboardPengelola', function () {
        return view('layoutAdmin.dashboard.pengelola.index');
    });

    Route::get('/alat_sewa/{alatsewa}/edit', [AlatSewaController::class, 'edit']);
    Route::patch('/alat_sewa/{alatsewa}', [AlatSewaController::class, 'update']);
    Route::get('/alat_sewa/{alatsewa}/destroy', [AlatSewaController::class, 'destroy']);
    Route::get('/alat_sewa/create', [AlatSewaController::class, 'create']);
    Route::post('/alat_sewa', [AlatSewaController::class, 'store']);

    Route::get('/alat_sewa/masuk', [AlatSewaController::class, 'masuk']);
    Route::post('/alatSewa', [AlatSewaController::class, 'tambah_stok']);

    Route::get('/makanan/create', [MakananController::class, 'create']);
    Route::post('/makanan', [MakananController::class, 'store']);
    Route::get('/makanan/{makanan}/edit', [MakananController::class, 'edit']);
    Route::patch('/makanan/{makanan}', [MakananController::class, 'update']);
    Route::get('/makanan/{makanan}/destroy', [MakananController::class, 'destroy']);

    Route::get('/makanan/masuk', [MakananController::class, 'masuk']);
    Route::post('/makananStok', [MakananController::class, 'tambah_stok']);

    Route::get('/hargaTiket/create', [HargaTiketController::class, 'create']);
    Route::post('/hargaTiket', [HargaTiketController::class, 'store']);
    Route::get('/hargaTiket/{hargaTiket}/edit', [HargaTiketController::class, 'edit']);
    Route::patch('/hargaTiket/{hargaTiket}', [HargaTiketController::class, 'update']);

    Route::get('/brg_hbs_pakai/create', [BarangController::class, 'create']);
    Route::post('/brg_hbs_pakai', [BarangController::class, 'store']);
    Route::get('/brg_hbs_pakai/{barang}/edit', [BarangController::class, 'edit']);
    Route::patch('/brg_hbs_pakai/{barang}', [BarangController::class, 'update']);
    Route::get('/brg_hbs_pakai/{barang}/destroy', [BarangController::class, 'destroy']);

    Route::get('/brg_hbs_pakai/masuk', [BarangController::class, 'masuk']);
    Route::post('/barang', [BarangController::class, 'tambah_stok']);

    Route::get('/lokasi/create', [LokasiController::class, 'create']);
    Route::post('/lokasi', [LokasiController::class, 'store']);
    Route::get('/lokasi/{lokasi}/edit', [LokasiController::class, 'edit']);
    Route::patch('/lokasi/{lokasi}', [LokasiController::class, 'update']);

    Route::get('/penyewaan_tambahan/create', [SewaAlatTambahController::class, 'create']);
    Route::post('/penyewaan_tambahan', [SewaAlatTambahController::class, 'store']);
    Route::get('/penyewaan_tambahan/{sewaAlatTambah}/kembali', [SewaAlatTambahController::class, 'kembali']);
    Route::patch('/penyewaan_tambahan/{sewaAlat}', [SewaAlatTambahController::class, 'dikembalikan']);

    Route::get('/beli_barang/create', [BeliBarangController::class, 'create']);
    Route::post('/beli_barang', [BeliBarangController::class, 'store']);

    Route::post('/validasi/{konfirmasi}', [ValidasiController::class, 'validasi']);

    Route::post('/pembatalan_tiket/{batalTiket}/refund', [BatalTiketController::class, 'refund']);

    Route::get('/check_in/create', [CheckInController::class, 'create']);
    Route::post('/check_in', [CheckInController::class, 'check']);

    Route::get('/check_out/create', [CheckOutController::class, 'create']);
    Route::post('/check_out', [CheckOutController::class, 'check']);

    Route::get('/check_out/penyewaan_tambahan/{sewaAlat}/kembali', [CheckOutController::class, 'penyewaan_tambahan_kembali']);
    Route::patch('/check_out/penyewaan_tambahan/{sewaAlat}', [CheckOutController::class, 'penyewaan_tambahan_dikembalikan']);

    Route::get('/check_out/penyewaan_tenda/{sewaAlat}/kembali', [CheckOutController::class, 'penyewaan_tenda_kembali']);
    Route::patch('/check_out/penyewaan_tenda/{sewaAlat}', [CheckOutController::class, 'penyewaan_tenda_dikembalikan']);

    Route::get('/pegawai/create', [PegawaiController::class, 'create']);
    Route::post('/pegawai', [PegawaiController::class, 'store']);
    Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit']);
    Route::patch('/pegawai/{pegawai}', [PegawaiController::class, 'update']);
    Route::get('/pegawai/{pegawai}/destroy', [PegawaiController::class, 'destroy']);

    Route::get('/shift_kerja/create', [ShiftKerjaController::class, 'create']);
    Route::post('/shift_kerja', [ShiftKerjaController::class, 'store']);
    Route::get('/shift_kerja/{shift}/edit', [ShiftKerjaController::class, 'edit']);
    Route::patch('/shift_kerja/{shift}', [ShiftKerjaController::class, 'update']);
    Route::get('/shift_kerja/{shift}/destroy', [ShiftKerjaController::class, 'destroy']);

    Route::get('/jadwal_piket/create', [JadwalPiketController::class, 'create']);
    Route::post('/jadwal_piket', [JadwalPiketController::class, 'store']);
    Route::get('/jadwal_piket/{jadwal}/edit', [JadwalPiketController::class, 'edit']);
    Route::patch('/jadwal_piket/{jadwal}', [JadwalPiketController::class, 'update']);
    Route::get('/jadwal_piket/{jadwal}/destroy', [JadwalPiketController::class, 'destroy']);
    Route::get('/jadwal_piket/deleteAll', [JadwalPiketController::class, 'deleteAll']);
});

Route::group(['middleware' => ['auth', 'checkLevel:admin,pengelola']], function () {
    Route::get('/user/admin', [UserController::class, 'admin']);
    Route::get('/user/pengunjung', [UserController::class, 'pengunjung']);
    Route::get('/user/pengunjung/download', [UserController::class, 'downloadPengunjung']);
    Route::get('/user/pengelola', [UserController::class, 'pengelola']);

    Route::get('/user/pengelola/{user}/edit', [UserController::class, 'editPengelola']);
    Route::patch('/user/pengelola/{user}/updatePengelola', [UserController::class, 'updatePengelola']);
    Route::get('/user/pengelola/{user}/editPasswordPengelola', [UserController::class, 'editPasswordPengelola']);
    Route::patch('/user/pengelola/{user}/updatePasswordPengelola', [UserController::class, 'updatePasswordPengelola']);

    Route::get('/alat_sewa', [AlatSewaController::class, 'index']);
    Route::get('/alat_sewa/{alatsewa}/detail', [AlatSewaController::class, 'detail']);
    Route::get('/alat_sewa/download', [AlatSewaController::class, 'download']);

    Route::get('/makanan', [MakananController::class, 'index']);
    Route::get('/makanan/{makanan}/show', [MakananController::class, 'show']);
    Route::get('/makanan/download', [MakananController::class, 'download']);

    Route::get('/hargaTiket', [HargaTiketController::class, 'index']);
    Route::get('/hargaTiket/download', [HargaTiketController::class, 'download']);

    Route::get('/brg_hbs_pakai', [BarangController::class, 'index']);
    Route::get('/brg_hbs_pakai/download', [BarangController::class, 'download']);

    Route::get('/lokasi', [LokasiController::class, 'index']);
    Route::get('/lokasi/download', [LokasiController::class, 'download']);

    Route::get('/penyewaan_tenda', [SewaAlatController::class, 'index']);
    Route::get('/penyewaan_tenda/{sewaAlat}', [SewaAlatController::class, 'showAdmin']);
    Route::get('/sewa_tenda/download', [SewaAlatController::class, 'download']);

    Route::get('/penyewaan_tambahan', [SewaAlatTambahController::class, 'index']);
    Route::get('/penyewaan_tambahan/{sewaAlatTambah}/show', [SewaAlatTambahController::class, 'show']);
    Route::get('/penyewaan_tambahan/download', [SewaAlatTambahController::class, 'download']);

    Route::get('/beli_barang', [BeliBarangController::class, 'index']);
    Route::get('/beli_barang/download', [BeliBarangController::class, 'download']);

    Route::get('/pemesanan_tiket', [PemesananController::class, 'indexAdmin']);
    Route::get('/pemesanan_tiket/{pemesanan}/showAdmin', [PemesananController::class, 'showAdmin']);
    Route::get('/pemesanan_tiket/downloadAdmin', [PemesananController::class, 'download']);

    Route::get('/konfirmasi_pembayaran', [KonfirmasiController::class, 'indexAdmin']);
    Route::get('/konfirmasi_pembayaran/{konfirmasi}/showAdmin', [KonfirmasiController::class, 'showAdmin']);
    Route::get('/konfirmasi_pembayaran/downloadAdmin', [KonfirmasiController::class, 'downloadAdmin']);

    Route::get('/pembatalan_tiket', [BatalTiketController::class, 'indexAdmin']);
    Route::get('/pembatalan_tiket/{batalTiket}/show', [BatalTiketController::class, 'showAdmin']);
    Route::get('/pembatalan_tiket/download', [BatalTiketController::class, 'download']);

    Route::get('/check_in', [CheckInController::class, 'index']);
    Route::get('/check_in/download', [CheckInController::class, 'download']);
    Route::get('/check_in/{checkIn}/show', [CheckInController::class, 'show']);

    Route::get('/check_out', [CheckOutController::class, 'index']);
    Route::get('/check_out/{checkOut}/show', [CheckOutController::class, 'show']);
    Route::get('/check_out/penyewaan_tambahan/{checkOut}', [CheckOutController::class, 'penyewaan_tambahan_index']);
    Route::get('/check_out/penyewaan_tambahan/{sewaAlat}/detail', [CheckOutController::class, 'penyewaan_tambahan_detail']);
    Route::get('/check_out/download', [CheckOutController::class, 'download']);

    Route::get('/check_out/penyewaan_tenda/{checkOut}', [CheckOutController::class, 'penyewaan_tenda_index']);
    Route::get('/check_out/penyewaan_tenda/{sewaAlat}/detail', [CheckOutController::class, 'penyewaan_tenda_detail']);

    Route::get('/rating_feedback', [RatingFeedbackController::class, 'indexAdmin']);
    Route::get('/rating_feedback/download', [RatingFeedbackController::class, 'download']);

    Route::get('/pemasukan', [PemasukanController::class, 'index']);

    Route::post('/pemasukan', [PemasukanController::class, 'get']);
    Route::get('/pemasukan/{pemesanan_tiket}/showTiket', [PemasukanController::class, 'showTiket']);
    Route::get('/pemasukanKeseluruhan', [PemasukanController::class, 'totalKeseluruhan']);
    Route::get('/pemasukan/penyewaan_tambahan/{sewaAlatTambah}/showSewa', [PemasukanController::class, 'showSewa']);
    Route::get('/pemasukan/penggantian_alat/{ganti}/showGanti', [PemasukanController::class, 'showGanti']);

    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/pegawai/download', [PegawaiController::class, 'download']);

    Route::get('/shift_kerja', [ShiftKerjaController::class, 'index']);
    Route::get('/shift_kerja/download', [ShiftKerjaController::class, 'download']);

    Route::get('/jadwal_piket', [JadwalPiketController::class, 'index']);
    Route::post('/jadwal_piket/print', [JadwalPiketController::class, 'print']);

    Route::get('/penggantian_alat', [PenggantianAlatRusakController::class, 'index']);
    Route::get('/penggantian_alat/{rusak}/show', [PenggantianAlatRusakController::class, 'show']);
    Route::get('/penggantian_alat/download', [PenggantianAlatRusakController::class, 'download']);

    Route::get('/pemesanan_makan', [PesanMakanController::class, 'index']);
    Route::get('/pemesanan_makan/create', [PesanMakanController::class, 'create']);
    Route::post('/pemesanan_makan', [PesanMakanController::class, 'store']);
    Route::get('/pemesanan_makan/download', [PesanMakanController::class, 'download']);

    Route::get('/kunjungan', [KunjunganController::class, 'index']);
    Route::get('/kunjunganToday', [KunjunganController::class, 'today']);
    Route::get('/kunjunganTotal', [KunjunganController::class, 'total']);
    Route::post('/kunjungan', [KunjunganController::class, 'get']);
});

Route::group(['middleware' => ['auth', 'checkLevel:admin,pengunjung,pengelola']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
