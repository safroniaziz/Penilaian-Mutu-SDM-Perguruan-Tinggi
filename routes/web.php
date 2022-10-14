<?php

use App\Http\Controllers\OperatorProdi\ProdiDashboardController;
use App\Http\Controllers\OperatorProdi\ProdiDosenController;
use App\Http\Controllers\OperatorProdi\ProdiProfilSayaController;
use App\Http\Controllers\OperatorUnit\UnitFakultasController;
use App\Http\Controllers\OperatorUnit\UnitDashboardController;
use App\Http\Controllers\OperatorUnit\UnitDosenController;
use App\Http\Controllers\OperatorUnit\UnitLembagaController;
use App\Http\Controllers\OperatorUnit\UnitProdiController;
use App\Http\Controllers\OperatorUnit\UnitProfilSayaController;
use App\Http\Controllers\OperatorUnit\UnitTendikController;
use App\Http\Controllers\OperatorUnit\UnitUptController;
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

Route::middleware('auth')->group(function() {
    Route::middleware('isOperatorUnit')->prefix('operator_unit')->group(function() {
        Route::get('/dashboard',[UnitDashboardController::class, 'dashboard'])->name('operator_unit.dashboard');

        Route::prefix('manajemen_data_fakultas')->group(function() {
            Route::get('/',[UnitFakultasController::class, 'index'])->name('operator_unit.fakultas');
            Route::get('/tambah_fakultas',[UnitFakultasController::class, 'add'])->name('operator_unit.fakultas.add');
            Route::post('/post',[UnitFakultasController::class, 'post'])->name('operator_unit.fakultas.post');
            Route::get('/{id}/edit',[UnitFakultasController::class, 'edit'])->name('operator_unit.fakultas.edit');
            Route::patch('/{id}/update',[UnitFakultasController::class, 'update'])->name('operator_unit.fakultas.update');
            Route::delete('{id}/delete',[UnitFakultasController::class, 'delete'])->name('operator_unit.fakultas.delete');
        });

        Route::prefix('manajemen_data_lembaga')->group(function() {
            Route::get('/',[UnitLembagaController::class, 'index'])->name('operator_unit.lembaga');
            Route::get('/tambah_lembaga',[UnitLembagaController::class, 'add'])->name('operator_unit.lembaga.add');
            Route::post('/post',[UnitLembagaController::class, 'post'])->name('operator_unit.lembaga.post');
            Route::get('/{id}/edit',[UnitLembagaController::class, 'edit'])->name('operator_unit.lembaga.edit');
            Route::patch('/{id}/update',[UnitLembagaController::class, 'update'])->name('operator_unit.lembaga.update');
            Route::delete('{id}/delete',[UnitLembagaController::class, 'delete'])->name('operator_unit.lembaga.delete');
        });

        Route::prefix('manajemen_data_upt')->group(function() {
            Route::get('/',[UnitUptController::class, 'index'])->name('operator_unit.upt');
            Route::get('/tambah_upt',[UnitUptController::class, 'add'])->name('operator_unit.upt.add');
            Route::post('/post',[UnitUptController::class, 'post'])->name('operator_unit.upt.post');
            Route::get('/{id}/edit',[UnitUptController::class, 'edit'])->name('operator_unit.upt.edit');
            Route::patch('/{id}/update',[UnitUptController::class, 'update'])->name('operator_unit.upt.update');
            Route::delete('{id}/delete',[UnitUptController::class, 'delete'])->name('operator_unit.upt.delete');
        });

        Route::prefix('manajemen_data_prodi')->group(function() {
            Route::get('/',[UnitProdiController::class, 'index'])->name('operator_unit.prodi');
            Route::get('/tambah_data_prodi',[UnitProdiController::class, 'add'])->name('operator_unit.prodi.add');
            Route::post('/post',[UnitProdiController::class, 'post'])->name('operator_unit.prodi.post');
            Route::get('/{id}/edit',[UnitProdiController::class, 'edit'])->name('operator_unit.prodi.edit');
            Route::patch('/{id}/update',[UnitProdiController::class, 'update'])->name('operator_unit.prodi.update');
            Route::delete('{id}/delete',[UnitProdiController::class, 'delete'])->name('operator_unit.prodi.delete');
        });

        Route::prefix('manajemen_data_dosen')->group(function() {
            Route::get('/',[UnitDosenController::class, 'index'])->name('operator_unit.dosen');
            Route::get('/tambah_data_dosen',[UnitDosenController::class, 'add'])->name('operator_unit.dosen.add');
            Route::post('/post',[UnitDosenController::class, 'post'])->name('operator_unit.dosen.post');
            Route::get('/{id}/edit',[UnitDosenController::class, 'edit'])->name('operator_unit.dosen.edit');
            Route::patch('/{id}/update',[UnitDosenController::class, 'update'])->name('operator_unit.dosen.update');
            Route::delete('{id}/delete',[UnitDosenController::class, 'delete'])->name('operator_unit.dosen.delete');
            Route::get('/cari_prodi',[UnitDosenController::class, 'cariProdi'])->name('operator_unit.cari_prodi');
        });

        Route::prefix('manajemen_data_tendik')->group(function() {
            Route::get('/',[UnitTendikController::class, 'index'])->name('operator_unit.tendik');
            Route::get('/tambah_data_tendik',[UnitTendikController::class, 'add'])->name('operator_unit.tendik.add');
            Route::post('/post',[UnitTendikController::class, 'post'])->name('operator_unit.tendik.post');
            Route::get('/{id}/edit',[UnitTendikController::class, 'edit'])->name('operator_unit.tendik.edit');
            Route::patch('/{id}/update',[UnitTendikController::class, 'update'])->name('operator_unit.tendik.update');
            Route::delete('{id}/delete',[UnitTendikController::class, 'delete'])->name('operator_unit.tendik.delete');
        });

        Route::prefix('profil_saya')->group(function() {
            Route::get('/',[UnitProfilSayaController::class, 'index'])->name('operator_unit.profil');
            Route::patch('/',[UnitProfilSayaController::class, 'ubahPassword'])->name('operator_unit.profil.ubah_password');
            Route::patch('{id}/update',[UnitProfilSayaController::class, 'update'])->name('operator_unit.profil.update');
        });
    });

    Route::middleware('isOperatorProdi')->prefix('operator_prodi')->group(function() {
        Route::get('/dashboard',[ProdiDashboardController::class, 'dashboard'])->name('operator_prodi.dashboard');

        Route::prefix('manajemen_data_dosen')->group(function() {
            Route::get('/',[ProdiDosenController::class, 'index'])->name('operator_prodi.dosen');
            Route::get('/tambah_data_dosen',[ProdiDosenController::class, 'add'])->name('operator_prodi.dosen.add');
            Route::post('/post',[ProdiDosenController::class, 'post'])->name('operator_prodi.dosen.post');
            Route::get('/{id}/edit',[ProdiDosenController::class, 'edit'])->name('operator_prodi.dosen.edit');
            Route::patch('/{id}/update',[ProdiDosenController::class, 'update'])->name('operator_prodi.dosen.update');
            Route::delete('{id}/delete',[ProdiDosenController::class, 'delete'])->name('operator_prodi.dosen.delete');
        });

        Route::prefix('profil_saya')->group(function() {
            Route::get('/',[ProdiProfilSayaController::class, 'index'])->name('operator_prodi.profil');
            Route::patch('/',[ProdiProfilSayaController::class, 'ubahPassword'])->name('operator_prodi.profil.ubah_password');
            Route::patch('{id}/update',[ProdiProfilSayaController::class, 'update'])->name('operator_prodi.profil.update');
        });
    });
});
