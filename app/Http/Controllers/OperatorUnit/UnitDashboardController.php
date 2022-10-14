<?php

namespace App\Http\Controllers\OperatorUnit;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class UnitDashboardController extends Controller
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
        $operator_unit = User::where('akses','operator_unit')->get();
        return view('operator_unit.dashboard',[
            'unit_kerja' => $unit_kerja->count(),
            'fakultas' => $fakultas->count(),
            'lembaga' => $lembaga->count(),
            'upt' => $upt->count(),
            'prodi' => $prodi->count(),
            'dosen' => $dosen->count(),
            'tendik' => $tendik->count(),
            'operator_prodi' => $operator_prodi->count(),
            'operator_unit' => $operator_unit->count(),
        ]);
    }
}
