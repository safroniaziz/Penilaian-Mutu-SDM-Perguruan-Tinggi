<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dosen\DosenDashboardController;
use App\Http\Controllers\Dosen\DosenSkpController;
use App\Http\Controllers\Fakultas\FakultasDashboardController;
use App\Http\Controllers\Fakultas\FakultasIkuController;
use App\Http\Controllers\IndikatorTendikBanPtController;
use App\Http\Controllers\Lpmpp\ReviewerIndikatorBanPt;
use App\Http\Controllers\Lppm\LaporanReview;
use App\Http\Controllers\OperatorProdi\ProdiDashboardController;
use App\Http\Controllers\OperatorProdi\ProdiDosenController;
use App\Http\Controllers\OperatorProdi\ProdiProfilSayaController;
use App\Http\Controllers\OperatorProdi\ProdiBkdPendidikanController;
use App\Http\Controllers\OperatorProdi\ProdiBkdPenelitianController;
use App\Http\Controllers\OperatorProdi\ProdiBkdPengabdianController;
use App\Http\Controllers\OperatorProdi\ProdiBkdProfesorController;
use App\Http\Controllers\OperatorProdi\ProdiBkdTridharmaController;
use App\Http\Controllers\Lppm\LppmFakultasController;
use App\Http\Controllers\Lppm\LppmIndikatorPenilaianController;
use App\Http\Controllers\Lppm\LppmBabIndikatorPenilaianController;
use App\Http\Controllers\Lppm\LppmDashboardController;
use App\Http\Controllers\Lppm\LppmDosenController;
use App\Http\Controllers\Lppm\LppmLembagaController;
use App\Http\Controllers\Lppm\LppmProdiController;
use App\Http\Controllers\Lppm\LppmProfilSayaController;
use App\Http\Controllers\Lppm\LppmTendikController;
use App\Http\Controllers\Lppm\LppmUptController;
use App\Http\Controllers\Lppm\LppmKriteriaTendikBpmAspekManajerialController;
use App\Http\Controllers\Lppm\LppmIndikatorTendikBpmAspekManajerialController;
use App\Http\Controllers\Lppm\LppmIndikatorTendikBpmAspekTeknisController;
use App\Http\Controllers\Lppm\LppmKriteriaTendikBpmAspekTeknisController;
use App\Http\Controllers\Lppm\ReviewerController;
use App\Http\Controllers\OperatorUnit\UnitDashboardController;
use App\Http\Controllers\OperatorUnit\UnitFormulirController;
use App\Http\Controllers\OperatorUnit\UnitTendikController;
use App\Http\Controllers\Reviewer\ReviewerDashboardController;
use App\Http\Controllers\ReviewerIndikatorBanPtTendikController;
use App\Http\Controllers\ReviewerIndikatorManajerialController;
use App\Http\Controllers\ReviewerIndikatorTeknisController;
use App\Http\Controllers\Tendik\TendikDashboardController;
use App\Http\Controllers\Tendik\TendikSkpController;
use App\Models\ReviewerIndikatorBanPtTendik;
use App\Models\ReviewerIndikatorTeknis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'authLogut'])->name('auth_logout');

Route::middleware('auth')->group(function () {
    Route::middleware('isLpmpp')->prefix('lpmpp')->group(function () {
        Route::get('/dashboard', [LppmDashboardController::class, 'dashboard'])->name('lpmpp.dashboard');

        Route::prefix('manajemen_data_fakultas')->group(function () {
            Route::get('/', [LppmFakultasController::class, 'index'])->name('lpmpp.fakultas');
            Route::get('/tambah_fakultas', [LppmFakultasController::class, 'add'])->name('lpmpp.fakultas.add');
            Route::post('/post', [LppmFakultasController::class, 'post'])->name('lpmpp.fakultas.post');
            Route::get('/{id}/edit', [LppmFakultasController::class, 'edit'])->name('lpmpp.fakultas.edit');
            Route::patch('/{id}/update', [LppmFakultasController::class, 'update'])->name('lpmpp.fakultas.update');
            Route::delete('{id}/delete', [LppmFakultasController::class, 'delete'])->name('lpmpp.fakultas.delete');
            Route::get('/cari_pimpinan', [LppmFakultasController::class, 'cariPimpinan'])->name('lpmpp.fakultas.cari_pimpinan');
        });

        Route::prefix('manajemen_data_indikator_penilaian')->group(function () {
            Route::get('/', [LppmIndikatorPenilaianController::class, 'index'])->name('lpmpp.indikator');
            Route::get('/tambah_indikator', [LppmIndikatorPenilaianController::class, 'add'])->name('lpmpp.indikator.add');
            Route::post('/post', [LppmIndikatorPenilaianController::class, 'post'])->name('lpmpp.indikator.post');
            Route::get('/{id}/edit', [LppmIndikatorPenilaianController::class, 'edit'])->name('lpmpp.indikator.edit');
            Route::patch('/{id}/update', [LppmIndikatorPenilaianController::class, 'update'])->name('lpmpp.indikator.update');
            Route::delete('{id}/delete', [LppmIndikatorPenilaianController::class, 'delete'])->name('lpmpp.indikator.delete');
        });

        Route::prefix('manajemen_data_bab_indikator_penilaian')->group(function () {
            Route::get('/', [LppmBabIndikatorPenilaianController::class, 'index'])->name('lpmpp.babIndikator');
            Route::get('/tambah_bab_indikator', [LppmBabIndikatorPenilaianController::class, 'add'])->name('lpmpp.babIndikator.add');
            Route::post('/post', [LppmBabIndikatorPenilaianController::class, 'post'])->name('lpmpp.babIndikator.post');
            Route::get('/{id}/edit', [LppmBabIndikatorPenilaianController::class, 'edit'])->name('lpmpp.babIndikator.edit');
            Route::patch('/{id}/update', [LppmBabIndikatorPenilaianController::class, 'update'])->name('lpmpp.babIndikator.update');
            Route::delete('{id}/delete', [LppmBabIndikatorPenilaianController::class, 'delete'])->name('lpmpp.babIndikator.delete');
        });

        Route::prefix('manajemen_data_reviewer_indikator_banpt')->group(function () {
            Route::get('/', [ReviewerIndikatorBanPt::class, 'index'])->name('lpmpp.reviewer_indikator_banpt');
            Route::get('/tambah_bab_indikator', [ReviewerIndikatorBanPt::class, 'add'])->name('lpmpp.reviewer_indikator_banpt.add');
            Route::post('/post', [ReviewerIndikatorBanPt::class, 'post'])->name('lpmpp.reviewer_indikator_banpt.post');
            Route::delete('{id}/delete', [ReviewerIndikatorBanPt::class, 'delete'])->name('lpmpp.reviewer_indikator_banpt.delete');
        });

        Route::prefix('manajemen_data_reviewer_indikator_aspek_teknis')->group(function () {
            Route::get('/', [ReviewerIndikatorTeknisController::class, 'index'])->name('lpmpp.reviewer_teknis');
            Route::get('/tambah_bab_indikator', [ReviewerIndikatorTeknisController::class, 'add'])->name('lpmpp.reviewer_teknis.add');
            Route::post('/post', [ReviewerIndikatorTeknisController::class, 'post'])->name('lpmpp.reviewer_teknis.post');
            Route::delete('{id}/delete', [ReviewerIndikatorTeknisController::class, 'delete'])->name('lpmpp.reviewer_teknis.delete');
        });

        Route::prefix('manajemen_data_reviewer_indikator_aspek_manajerial')->group(function () {
            Route::get('/', [ReviewerIndikatorManajerialController::class, 'index'])->name('lpmpp.reviewer_manajerial');
            Route::get('/tambah_bab_indikator', [ReviewerIndikatorManajerialController::class, 'add'])->name('lpmpp.reviewer_manajerial.add');
            Route::post('/post', [ReviewerIndikatorManajerialController::class, 'post'])->name('lpmpp.reviewer_manajerial.post');
            Route::delete('{id}/delete', [ReviewerIndikatorManajerialController::class, 'delete'])->name('lpmpp.reviewer_manajerial.delete');
        });

        Route::prefix('manajemen_data_reviewer_indikator_ban_pt_tendik')->group(function () {
            Route::get('/', [ReviewerIndikatorBanPtTendikController::class, 'index'])->name('lpmpp.reviewer_ban_pt_tendik');
            Route::get('/tambah_bab_indikator', [ReviewerIndikatorBanPtTendikController::class, 'add'])->name('lpmpp.reviewer_ban_pt_tendik.add');
            Route::post('/post', [ReviewerIndikatorBanPtTendikController::class, 'post'])->name('lpmpp.reviewer_ban_pt_tendik.post');
            Route::delete('{id}/delete', [ReviewerIndikatorBanPtTendikController::class, 'delete'])->name('lpmpp.reviewer_ban_pt_tendik.delete');
        });

        Route::prefix('manajemen_data_reviewer')->group(function () {
            Route::get('/', [ReviewerController::class, 'index'])->name('lpmpp.reviewers');
            Route::get('/tambah_bab_indikator', [ReviewerController::class, 'add'])->name('lpmpp.reviewers.add');
            Route::post('/post', [ReviewerController::class, 'post'])->name('lpmpp.reviewers.post');
            Route::get('/{id}/edit', [ReviewerController::class, 'edit'])->name('lpmpp.reviewers.edit');
            Route::patch('/{id}/update', [ReviewerController::class, 'update'])->name('lpmpp.reviewers.update');
            Route::delete('{id}/delete', [ReviewerController::class, 'delete'])->name('lpmpp.reviewers.delete');
        });

        Route::prefix('manajemen_indikator_mutu_tendik_ban_pt')->group(function () {
            Route::get('/', [IndikatorTendikBanPtController::class, 'index'])->name('lpmpp.tendik_ban_pt');
            Route::get('/tambah_indikator_aspek_teknis', [IndikatorTendikBanPtController::class, 'add'])->name('lpmpp.tendik_ban_pt.add');
            Route::post('/post', [IndikatorTendikBanPtController::class, 'post'])->name('lpmpp.tendik_ban_pt.post');
            Route::get('/{id}/edit', [IndikatorTendikBanPtController::class, 'edit'])->name('lpmpp.tendik_ban_pt.edit');
            Route::patch('/{id}/update', [IndikatorTendikBanPtController::class, 'update'])->name('lpmpp.tendik_ban_pt.update');
            Route::delete('{id}/delete', [IndikatorTendikBanPtController::class, 'delete'])->name('lpmpp.tendik_ban_pt.delete');
        });

        // KriteriaTendikBpmAspekTeknis
        Route::prefix('manajemen_data_kriteria_aspek_teknis')->group(function () {
            Route::get('/', [LppmKriteriaTendikBpmAspekTeknisController::class, 'index'])->name('lpmpp.KriteriaTendikBpmAspekTeknis');
            Route::get('/add', [LppmKriteriaTendikBpmAspekTeknisController::class, 'add'])->name('lpmpp.KriteriaTendikBpmAspekTeknis.add');
            Route::post('/post', [LppmKriteriaTendikBpmAspekTeknisController::class, 'post'])->name('lpmpp.KriteriaTendikBpmAspekTeknis.post');
            Route::get('/{id}/edit', [LppmKriteriaTendikBpmAspekTeknisController::class, 'edit'])->name('lpmpp.KriteriaTendikBpmAspekTeknis.edit');
            Route::patch('/{id}/update', [LppmKriteriaTendikBpmAspekTeknisController::class, 'update'])->name('lpmpp.KriteriaTendikBpmAspekTeknis.update');
            Route::delete('{id}/delete', [LppmKriteriaTendikBpmAspekTeknisController::class, 'delete'])->name('lpmpp.KriteriaTendikBpmAspekTeknis.delete');
        });

        // IndikatorTendikBpmAspekTeknis
        Route::prefix('manajemen_data_indikator_aspek_teknis')->group(function () {
            Route::get('/', [LppmIndikatorTendikBpmAspekTeknisController::class, 'index'])->name('lpmpp.IndikatorTendikBpmAspekTeknis');
            Route::get('/tambah_indikator_aspek_teknis', [LppmIndikatorTendikBpmAspekTeknisController::class, 'add'])->name('lpmpp.IndikatorTendikBpmAspekTeknis.add');
            Route::post('/post', [LppmIndikatorTendikBpmAspekTeknisController::class, 'post'])->name('lpmpp.IndikatorTendikBpmAspekTeknis.post');
            Route::get('/{id}/edit', [LppmIndikatorTendikBpmAspekTeknisController::class, 'edit'])->name('lpmpp.IndikatorTendikBpmAspekTeknis.edit');
            Route::patch('/{id}/update', [LppmIndikatorTendikBpmAspekTeknisController::class, 'update'])->name('lpmpp.IndikatorTendikBpmAspekTeknis.update');
            Route::delete('{id}/delete', [LppmIndikatorTendikBpmAspekTeknisController::class, 'delete'])->name('lpmpp.IndikatorTendikBpmAspekTeknis.delete');
        });

        // KriteriaTendikBpmAspekManajerial
        Route::prefix('manajemen_data_kriteria_aspek_manajerial')->group(function () {
            Route::get('/', [LppmKriteriaTendikBpmAspekManajerialController::class, 'index'])->name('lpmpp.KriteriaTendikBpmAspekManajerial');
            Route::get('/tambah_kriteria_aspek_manajerial', [LppmKriteriaTendikBpmAspekManajerialController::class, 'add'])->name('lpmpp.KriteriaTendikBpmAspekManajerial.add');
            Route::post('/post', [LppmKriteriaTendikBpmAspekManajerialController::class, 'post'])->name('lpmpp.KriteriaTendikBpmAspekManajerial.post');
            Route::get('/{id}/edit', [LppmKriteriaTendikBpmAspekManajerialController::class, 'edit'])->name('lpmpp.KriteriaTendikBpmAspekManajerial.edit');
            Route::patch('/{id}/update', [LppmKriteriaTendikBpmAspekManajerialController::class, 'update'])->name('lpmpp.KriteriaTendikBpmAspekManajerial.update');
            Route::delete('{id}/delete', [LppmKriteriaTendikBpmAspekManajerialController::class, 'delete'])->name('lpmpp.KriteriaTendikBpmAspekManajerial.delete');
        });

        // IndikatorTendikBpmAspekManajerial
        Route::prefix('manajemen_data_indikator_aspek_manajerial')->group(function () {
            Route::get('/', [LppmIndikatorTendikBpmAspekManajerialController::class, 'index'])->name('lpmpp.IndikatorTendikBpmAspekManajerial');
            Route::get('/tambah_indikator_aspek_manajerial', [LppmIndikatorTendikBpmAspekManajerialController::class, 'add'])->name('lpmpp.IndikatorTendikBpmAspekManajerial.add');
            Route::post('/post', [LppmIndikatorTendikBpmAspekManajerialController::class, 'post'])->name('lpmpp.IndikatorTendikBpmAspekManajerial.post');
            Route::get('/{id}/edit', [LppmIndikatorTendikBpmAspekManajerialController::class, 'edit'])->name('lpmpp.IndikatorTendikBpmAspekManajerial.edit');
            Route::patch('/{id}/update', [LppmIndikatorTendikBpmAspekManajerialController::class, 'update'])->name('lpmpp.IndikatorTendikBpmAspekManajerial.update');
            Route::delete('{id}/delete', [LppmIndikatorTendikBpmAspekManajerialController::class, 'delete'])->name('lpmpp.IndikatorTendikBpmAspekManajerial.delete');
        });


        Route::prefix('manajemen_data_lembaga')->group(function () {
            Route::get('/', [LppmLembagaController::class, 'index'])->name('lpmpp.lembaga');
            Route::get('/tambah_lembaga', [LppmLembagaController::class, 'add'])->name('lpmpp.lembaga.add');
            Route::post('/post', [LppmLembagaController::class, 'post'])->name('lpmpp.lembaga.post');
            Route::get('/{id}/edit', [LppmLembagaController::class, 'edit'])->name('lpmpp.lembaga.edit');
            Route::patch('/{id}/update', [LppmLembagaController::class, 'update'])->name('lpmpp.lembaga.update');
            Route::delete('{id}/delete', [LppmLembagaController::class, 'delete'])->name('lpmpp.lembaga.delete');
        });

        Route::prefix('manajemen_data_upt')->group(function () {
            Route::get('/', [LppmUptController::class, 'index'])->name('lpmpp.upt');
            Route::get('/tambah_upt', [LppmUptController::class, 'add'])->name('lpmpp.upt.add');
            Route::post('/post', [LppmUptController::class, 'post'])->name('lpmpp.upt.post');
            Route::get('/{id}/edit', [LppmUptController::class, 'edit'])->name('lpmpp.upt.edit');
            Route::patch('/{id}/update', [LppmUptController::class, 'update'])->name('lpmpp.upt.update');
            Route::delete('{id}/delete', [LppmUptController::class, 'delete'])->name('lpmpp.upt.delete');
        });

        Route::prefix('manajemen_data_prodi')->group(function () {
            Route::get('/', [LppmProdiController::class, 'index'])->name('lpmpp.prodi');
            Route::get('/tambah_data_prodi', [LppmProdiController::class, 'add'])->name('lpmpp.prodi.add');
            Route::post('/post', [LppmProdiController::class, 'post'])->name('lpmpp.prodi.post');
            Route::get('/{id}/edit', [LppmProdiController::class, 'edit'])->name('lpmpp.prodi.edit');
            Route::patch('/{id}/update', [LppmProdiController::class, 'update'])->name('lpmpp.prodi.update');
            Route::delete('{id}/delete', [LppmProdiController::class, 'delete'])->name('lpmpp.prodi.delete');
            Route::get('/sync', [LppmProdiController::class, 'sync'])->name('lpmpp.prodi.sync');
            Route::get('{prodi}/sync_mahasiswa', [LppmProdiController::class, 'syncMahasiswa'])->name('lpmpp.prodi.sync_mahasiswa');
            Route::get('{prodi}/sync_mahasiswa_detail', [LppmProdiController::class, 'syncMahasiswaDetail'])->name('lpmpp.prodi.sync_mahasiswa_detail');
            Route::get('{prodi}/detail_mahasiswa', [LppmProdiController::class, 'detailMahasiswa'])->name('lpmpp.prodi.detail_mahasiswa');

            Route::get('{prodi}/sync_dosen', [LppmProdiController::class, 'syncDosen'])->name('lpmpp.prodi.sync_dosen');
            Route::get('{prodi}/sync_dosen_detail', [LppmProdiController::class, 'syncDosenDetail'])->name('lpmpp.prodi.sync_dosen_detail');
            Route::get('{prodi}/detail_dosen', [LppmProdiController::class, 'detailDosen'])->name('lpmpp.prodi.detail_dosen');
        });

        Route::prefix('manajemen_data_dosen')->group(function () {
            Route::get('/', [LppmDosenController::class, 'index'])->name('lpmpp.dosen');
            Route::get('/tambah_data_dosen', [LppmDosenController::class, 'add'])->name('lpmpp.dosen.add');
            Route::post('/post', [LppmDosenController::class, 'post'])->name('lpmpp.dosen.post');
            Route::get('/{id}/edit', [LppmDosenController::class, 'edit'])->name('lpmpp.dosen.edit');
            Route::patch('/{id}/update', [LppmDosenController::class, 'update'])->name('lpmpp.dosen.update');
            Route::delete('{id}/delete', [LppmDosenController::class, 'delete'])->name('lpmpp.dosen.delete');
            Route::get('/cari_prodi', [LppmDosenController::class, 'cariProdi'])->name('lpmpp.cari_prodi');
            Route::get('{fakultas}/detail', [LppmDosenController::class, 'detailDosen'])->name('lpmpp.dosen.detail');
        });

        Route::prefix('manajemen_data_tendik')->group(function () {
            Route::get('/', [LppmTendikController::class, 'index'])->name('lpmpp.tendik');
            Route::get('/tambah_data_tendik', [LppmTendikController::class, 'add'])->name('lpmpp.tendik.add');
            Route::post('/post', [LppmTendikController::class, 'post'])->name('lpmpp.tendik.post');
            Route::get('/{id}/edit', [LppmTendikController::class, 'edit'])->name('lpmpp.tendik.edit');
            Route::patch('/{id}/update', [LppmTendikController::class, 'update'])->name('lpmpp.tendik.update');
            Route::delete('{id}/delete', [LppmTendikController::class, 'delete'])->name('lpmpp.tendik.delete');
        });

        Route::prefix('laporan_hasil_review')->group(function () {
            Route::get('/ban_pt_dosen', [LaporanReview::class, 'banPtDosen'])->name('lpmpp.ban_pt_dosen');
            Route::get('/laporan_teknis', [LaporanReview::class, 'laporanTeknis'])->name('lpmpp.laporan_teknis');
            Route::get('/laporan_manajerial', [LaporanReview::class, 'laporanManajerial'])->name('lpmpp.laporan_manajerial');
            Route::get('/laporan_banpt_tendik', [LaporanReview::class, 'laporanBanPtTendik'])->name('lpmpp.laporan_banpt_tendik');
        });

        Route::prefix('profil_saya')->group(function () {
            Route::get('/', [LppmProfilSayaController::class, 'index'])->name('lpmpp.profil');
            Route::patch('/', [LppmProfilSayaController::class, 'ubahPassword'])->name('lpmpp.profil.ubah_password');
            Route::patch('{id}/update', [LppmProfilSayaController::class, 'update'])->name('lpmpp.profil.update');
        });
    });

    Route::middleware('isOperatorProdi')->prefix('operator_prodi')->group(function () {
        Route::get('/dashboard', [ProdiDashboardController::class, 'dashboard'])->name('operator_prodi.dashboard');

        Route::prefix('manajemen_data_dosen')->group(function () {
            Route::get('/', [ProdiDosenController::class, 'index'])->name('operator_prodi.dosen');
            Route::get('/tambah_data_dosen', [ProdiDosenController::class, 'add'])->name('operator_prodi.dosen.add');
            Route::post('/post', [ProdiDosenController::class, 'post'])->name('operator_prodi.dosen.post');
            Route::get('/{id}/edit', [ProdiDosenController::class, 'edit'])->name('operator_prodi.dosen.edit');
            Route::patch('/{id}/update', [ProdiDosenController::class, 'update'])->name('operator_prodi.dosen.update');
            Route::delete('{id}/delete', [ProdiDosenController::class, 'delete'])->name('operator_prodi.dosen.delete');
        });

        Route::prefix('beban_kinerja_dosen')->group(function () {
            Route::prefix('bidang_pendidikan')->group(function () {
                Route::get('/', [ProdiBkdPendidikanController::class, 'index'])->name('operator_prodi.bkd_pendidikan');
                Route::get('/pilih_dosen', [ProdiBkdPendidikanController::class, 'pilihDosen'])->name('operator_prodi.bkd_pendidikan.pilih_dosen');
                Route::get('/tambah_data', [ProdiBkdPendidikanController::class, 'add'])->name('operator_prodi.bkd_pendidikan.add');
                Route::post('/post', [ProdiBkdPendidikanController::class, 'post'])->name('operator_prodi.bkd_pendidikan.post');
                Route::get('/{id}/edit', [ProdiBkdPendidikanController::class, 'edit'])->name('operator_prodi.bkd_pendidikan.edit');
                Route::patch('/{id}/update', [ProdiBkdPendidikanController::class, 'update'])->name('operator_prodi.bkd_pendidikan.update');
                Route::delete('{id}/delete', [ProdiBkdPendidikanController::class, 'delete'])->name('operator_prodi.bkd_pendidikan.delete');
            });

            Route::prefix('bidang_penelitian_dan_pengembangan_ilmu')->group(function () {
                Route::get('/', [ProdiBkdPenelitianController::class, 'index'])->name('operator_prodi.bkd_penelitian');
                Route::get('/pilih_dosen', [ProdiBkdPenelitianController::class, 'pilihDosen'])->name('operator_prodi.bkd_penelitian.pilih_dosen');
                Route::get('/tambah_data', [ProdiBkdPenelitianController::class, 'add'])->name('operator_prodi.bkd_penelitian.add');
                Route::post('/post', [ProdiBkdPenelitianController::class, 'post'])->name('operator_prodi.bkd_penelitian.post');
                Route::get('/{id}/edit', [ProdiBkdPenelitianController::class, 'edit'])->name('operator_prodi.bkd_penelitian.edit');
                Route::patch('/{id}/update', [ProdiBkdPenelitianController::class, 'update'])->name('operator_prodi.bkd_penelitian.update');
                Route::delete('{id}/delete', [ProdiBkdPenelitianController::class, 'delete'])->name('operator_prodi.bkd_penelitian.delete');
            });

            Route::prefix('bidang_pengabdian_pada_masyarakat')->group(function () {
                Route::get('/', [ProdiBkdPengabdianController::class, 'index'])->name('operator_prodi.bkd_pengabdian');
                Route::get('/pilih_dosen', [ProdiBkdPengabdianController::class, 'pilihDosen'])->name('operator_prodi.bkd_pengabdian.pilih_dosen');
                Route::get('/tambah_data', [ProdiBkdPengabdianController::class, 'add'])->name('operator_prodi.bkd_pengabdian.add');
                Route::post('/post', [ProdiBkdPengabdianController::class, 'post'])->name('operator_prodi.bkd_pengabdian.post');
                Route::get('/{id}/edit', [ProdiBkdPengabdianController::class, 'edit'])->name('operator_prodi.bkd_pengabdian.edit');
                Route::patch('/{id}/update', [ProdiBkdPengabdianController::class, 'update'])->name('operator_prodi.bkd_pengabdian.update');
                Route::delete('{id}/delete', [ProdiBkdPengabdianController::class, 'delete'])->name('operator_prodi.bkd_pengabdian.delete');
            });

            Route::prefix('bidang_tridharma_perguruan_tinggi')->group(function () {
                Route::get('/', [ProdiBkdTridharmaController::class, 'index'])->name('operator_prodi.bkd_tridharma');
                Route::get('/pilih_dosen', [ProdiBkdTridharmaController::class, 'pilihDosen'])->name('operator_prodi.bkd_tridharma.pilih_dosen');
                Route::get('/tambah_data', [ProdiBkdTridharmaController::class, 'add'])->name('operator_prodi.bkd_tridharma.add');
                Route::post('/post', [ProdiBkdTridharmaController::class, 'post'])->name('operator_prodi.bkd_tridharma.post');
                Route::get('/{id}/edit', [ProdiBkdTridharmaController::class, 'edit'])->name('operator_prodi.bkd_tridharma.edit');
                Route::patch('/{id}/update', [ProdiBkdTridharmaController::class, 'update'])->name('operator_prodi.bkd_tridharma.update');
                Route::delete('{id}/delete', [ProdiBkdTridharmaController::class, 'delete'])->name('operator_prodi.bkd_tridharma.delete');
            });

            Route::prefix('bidang_kewajiban_khusus_profesor')->group(function () {
                Route::get('/', [ProdiBkdProfesorController::class, 'index'])->name('operator_prodi.bkd_profesor');
                Route::get('/pilih_dosen', [ProdiBkdProfesorController::class, 'pilihDosen'])->name('operator_prodi.bkd_profesor.pilih_dosen');
                Route::get('/tambah_data', [ProdiBkdProfesorController::class, 'add'])->name('operator_prodi.bkd_profesor.add');
                Route::post('/post', [ProdiBkdProfesorController::class, 'post'])->name('operator_prodi.bkd_profesor.post');
                Route::get('/{id}/edit', [ProdiBkdProfesorController::class, 'edit'])->name('operator_prodi.bkd_profesor.edit');
                Route::patch('/{id}/update', [ProdiBkdProfesorController::class, 'update'])->name('operator_prodi.bkd_profesor.update');
                Route::delete('{id}/delete', [ProdiBkdProfesorController::class, 'delete'])->name('operator_prodi.bkd_profesor.delete');
            });
        });

        Route::prefix('profil_saya')->group(function () {
            Route::get('/', [ProdiProfilSayaController::class, 'index'])->name('operator_prodi.profil');
            Route::patch('/', [ProdiProfilSayaController::class, 'ubahPassword'])->name('operator_prodi.profil.ubah_password');
            Route::patch('{id}/update', [ProdiProfilSayaController::class, 'update'])->name('operator_prodi.profil.update');
        });
    });

    Route::middleware('isOperatorUnit')->prefix('operator_unit')->group(function () {
        Route::get('/dashboard', [UnitDashboardController::class, 'dashboard'])->name('operator_unit.dashboard');

        Route::prefix('manajemen_data_tendik')->group(function () {
            Route::get('/', [UnitTendikController::class, 'index'])->name('operator_unit.tendik');
            Route::get('/tambah_data_tendik', [UnitTendikController::class, 'add'])->name('operator_unit.tendik.add');
            Route::post('/post', [UnitTendikController::class, 'post'])->name('operator_unit.tendik.post');
            Route::get('/{id}/edit', [UnitTendikController::class, 'edit'])->name('operator_unit.tendik.edit');
            Route::patch('/{id}/update', [UnitTendikController::class, 'update'])->name('operator_unit.tendik.update');
            Route::delete('{id}/delete', [UnitTendikController::class, 'delete'])->name('operator_unit.tendik.delete');
        });

        Route::prefix('formulir_sasaran_kerja_pegawai')->group(function () {
            Route::get('/', [UnitFormulirController::class, 'index'])->name('operator_unit.formulir');
            Route::get('/tambah_data', [UnitFormulirController::class, 'add'])->name('operator_unit.formulir.add');
            Route::post('/post', [UnitFormulirController::class, 'post'])->name('operator_unit.formulir.post');
            Route::get('/{id}/edit', [UnitFormulirController::class, 'edit'])->name('operator_unit.formulir.edit');
            Route::patch('/{id}/update', [UnitFormulirController::class, 'update'])->name('operator_unit.formulir.update');
            Route::delete('{id}/delete', [UnitFormulirController::class, 'delete'])->name('operator_unit.formulir.delete');
            Route::get('/pilih_tendik', [UnitFormulirController::class, 'pilihTendik'])->name('operator_unit.formulir.pilih_tendik');
        });

        Route::prefix('profil_saya')->group(function () {
            Route::get('/', [UnitProfilSayaController::class, 'index'])->name('operator_unit.profil');
            Route::patch('/', [UnitProfilSayaController::class, 'ubahPassword'])->name('operator_unit.profil.ubah_password');
            Route::patch('{id}/update', [UnitProfilSayaController::class, 'update'])->name('operator_unit.profil.update');
        });
    });

    Route::middleware('isOperatorFakultas')->prefix('operator_fakultas')->group(function () {
        Route::get('/dashboard', [FakultasDashboardController::class, 'dashboard'])->name('operator_fakultas.dashboard');

        Route::prefix('manajemen_data_iku_pimpinan')->group(function () {
            Route::get('/', [FakultasIkuController::class, 'index'])->name('operator_fakultas.iku');
            Route::get('/tambah_data_iku', [FakultasIkuController::class, 'add'])->name('operator_fakultas.iku.add');
            Route::post('/post', [FakultasIkuController::class, 'post'])->name('operator_fakultas.iku.post');
            Route::get('/{ikk}/edit', [FakultasIkuController::class, 'edit'])->name('operator_fakultas.iku.edit');
            Route::patch('/{ikk}/update', [FakultasIkuController::class, 'update'])->name('operator_fakultas.iku.update');
            Route::delete('{ikk}/delete', [FakultasIkuController::class, 'delete'])->name('operator_fakultas.iku.delete');
        });

        Route::prefix('profil_saya')->group(function () {
            Route::get('/', [UnitProfilSayaController::class, 'index'])->name('operator_fakultas.profil');
            Route::patch('/', [UnitProfilSayaController::class, 'ubahPassword'])->name('operator_fakultas.profil.ubah_password');
            Route::patch('{id}/update', [UnitProfilSayaController::class, 'update'])->name('operator_fakultas.profil.update');
        });
    });
});

Route::middleware('isDosen')->prefix('dosen')->group(function () {
    Route::get('/dashboard', [DosenDashboardController::class, 'dashboard'])->name('dosen.dashboard');

    Route::prefix('manajemen_data_skp')->group(function () {
        Route::get('/', [DosenSkpController::class, 'index'])->name('dosen.skp');
        Route::post('{dosen}/post', [DosenSkpController::class, 'post'])->name('dosen.skp.post');
        Route::get('/{skp}/detail', [DosenSkpController::class, 'detail'])->name('dosen.skp.detail');
        Route::get('/cari_ikk', [DosenSkpController::class, 'cariIkk'])->name('dosen.skp.cari_ikk');
        Route::post('{skp}/detail_post', [DosenSkpController::class, 'detailPost'])->name('dosen.skp.detail_post');
        Route::get('/{skpDetail}/edit', [DosenSkpController::class, 'skpDetailEdit'])->name('dosen.skp.skp_detail_edit');
        Route::patch('/{skpDetail}/update', [DosenSkpController::class, 'skpDetailUpdate'])->name('dosen.skp.skp_detail_update');
        Route::delete('/detail_delete', [DosenSkpController::class, 'detailDelete'])->name('dosen.skp.detail_delete');

        //cetak
        Route::get('/cetak_skp_pegawai', [DosenSkpController::class, 'cetakSkpPegawai'])->name('dosen.skp.cetak_skp_pegawai');
        Route::get('/cetak_sasaran_kinerja_pegawai', [DosenSkpController::class, 'cetakSasaranKinerjaPegawai'])->name('dosen.skp.cetak_sasaran_kinerja_pegawai');
        Route::get('/evaluasi_pegawai', [DosenSkpController::class, 'cetakEvaluasiPegawai'])->name('dosen.skp.evaluasi_pegawai');
        Route::get('/cetak_nilai_kinerja', [DosenSkpController::class, 'cetakNilaiKinerja'])->name('dosen.skp.cetak_nilai_kinerja');
    });

    Route::prefix('profil_saya')->group(function () {
        Route::get('/', [LppmProfilSayaController::class, 'index'])->name('dosen.profil');
        Route::patch('/', [LppmProfilSayaController::class, 'ubahPassword'])->name('dosen.profil.ubah_password');
        Route::patch('{id}/update', [LppmProfilSayaController::class, 'update'])->name('dosen.profil.update');
    });
});

Route::middleware('isTendik')->prefix('tendik')->group(function() {
    Route::get('/dashboard',[TendikDashboardController::class, 'dashboard'])->name('tendik.dashboard');

    Route::prefix('manajemen_data_skp')->group(function() {
        Route::get('/',[TendikSkpController::class, 'index'])->name('tendik.skp');
        Route::post('/post',[TendikSkpController::class, 'post'])->name('tendik.skp.post');
        Route::get('/{skp}/detail',[TendikSkpController::class, 'detail'])->name('tendik.skp.detail');
        Route::get('/cari_ikk',[TendikSkpController::class, 'cariIkk'])->name('tendik.skp.cari_ikk');
        Route::post('{skp}/detail_post',[TendikSkpController::class, 'detailPost'])->name('tendik.skp.detail_post');
        Route::get('/{skpDetail}/edit',[TendikSkpController::class, 'skpDetailEdit'])->name('tendik.skp.skp_detail_edit');
        Route::patch('/{skpDetail}/update',[TendikSkpController::class, 'skpDetailUpdate'])->name('tendik.skp.skp_detail_update');
        Route::delete('/detail_delete',[TendikSkpController::class, 'detailDelete'])->name('tendik.skp.detail_delete');
        
        //cetak
        Route::get('/cetak_skp_pegawai',[TendikSkpController::class, 'cetakSkpPegawai'])->name('tendik.skp.cetak_skp_pegawai');
        Route::get('/cetak_sasaran_kinerja_pegawai',[TendikSkpController::class, 'cetakSasaranKinerjaPegawai'])->name('tendik.skp.cetak_sasaran_kinerja_pegawai');
        Route::get('/evaluasi_pegawai',[TendikSkpController::class, 'cetakEvaluasiPegawai'])->name('tendik.skp.evaluasi_pegawai');
        Route::get('/cetak_nilai_kinerja',[TendikSkpController::class, 'cetakNilaiKinerja'])->name('tendik.skp.cetak_nilai_kinerja');
    });

    Route::prefix('profil_saya')->group(function() {
        Route::get('/',[LppmProfilSayaController::class, 'index'])->name('tendik.profil');
        Route::patch('/',[LppmProfilSayaController::class, 'ubahPassword'])->name('tendik.profil.ubah_password');
        Route::patch('{id}/update',[LppmProfilSayaController::class, 'update'])->name('tendik.profil.update');
    });
});

Route::middleware('isReviewer')->prefix('reviewer')->group(function() {
    Route::get('/dashboard',[ReviewerDashboardController::class, 'dashboard'])->name('reviewer.dashboard');

    Route::prefix('penilaian')->group(function() {
        Route::get('/mutu_dosen_ban_pt',[ReviewerDashboardController::class, 'banPtDosen'])->name('reviewer.penilaian_banpt_dosen');
        Route::post('/mutu_dosen_ban_pt_post',[ReviewerDashboardController::class, 'banPtDosenPost'])->name('reviewer.penilaian_banpt_dosen.post');

        Route::get('/penilaian_teknis',[ReviewerDashboardController::class, 'teknisTendik'])->name('reviewer.penilaian_teknis');
        Route::post('/penilaian_teknis_post',[ReviewerDashboardController::class, 'teknisTendikPost'])->name('reviewer.penilaian_teknis.post');
        
        Route::get('/penilaian_manajerial',[ReviewerDashboardController::class, 'manajerialTendik'])->name('reviewer.penilaian_manajerial');
        Route::post('/penilaian_manajerial_post',[ReviewerDashboardController::class, 'manajerialTendikPost'])->name('reviewer.penilaian_manajerial.post');

        Route::get('/mutu_tendik_ban_pt',[ReviewerDashboardController::class, 'banPtTendik'])->name('reviewer.penilaian_banpt_tendik');
        Route::post('/mutu_tendik_ban_pt_post',[ReviewerDashboardController::class, 'banPtTendikPost'])->name('reviewer.penilaian_banpt_tendik.post');
    });

    Route::prefix('profil_saya')->group(function() {
        Route::get('/',[LppmProfilSayaController::class, 'index'])->name('reviewer.profil');
        Route::patch('/',[LppmProfilSayaController::class, 'ubahPassword'])->name('reviewer.profil.ubah_password');
        Route::patch('{id}/update',[LppmProfilSayaController::class, 'update'])->name('reviewer.profil.update');
    });
});


Route::get('/asesor', function () {
    return view('asesor');
});
