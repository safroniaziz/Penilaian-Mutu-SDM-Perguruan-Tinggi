<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class LppmDashboardController extends Controller
{
    public function dashboard(){
        $unit_kerja = Unit::all();
        $fakultas   = Unit::where('jenis_unit','fakultas')->get();
        $lembaga   = Unit::where('jenis_unit','lembaga')->get();
        $upt   = Unit::where('jenis_unit','upt')->get();
        $prodi = Prodi::all();
        $dosen = User::where('akses','dosen')->get();
        $tendik = User::where('akses','tendik')->get();
        $operator_prodi = User::where('akses','operator_prodi')->get();
        $lpmpp = User::where('akses','lpmpp')->get();
        return view('lpmpp.dashboard',[
            'unit_kerja' => $unit_kerja->count(),
            'fakultas' => $fakultas->count(),
            'lembaga' => $lembaga->count(),
            'upt' => $upt->count(),
            'prodi' => $prodi->count(),
            'dosen' => $dosen->count(),
            'tendik' => $tendik->count(),
            'operator_prodi' => $operator_prodi->count(),
            'lpmpp' => $lpmpp->count(),
        ]);
    }
}
