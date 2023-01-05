<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Tendik;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LppmDashboardController extends Controller
{
    public function dashboard(){
        // data grafik dosen
        $grafikPerFakultas = Unit::with('prodis')->where('jenis_unit','fakultas')->get();
        $grafikPerGolongan = Dosen::select(DB::raw('count(id) as jumlah_dosen'),'golongan')->groupBy('golongan')->get();
        $grafikPerJabatan = Dosen::select(DB::raw('count(id) as jumlah_dosen'),'jabatan_akademik')->groupBy('jabatan_akademik')->get();
        $grafikPerJk = Dosen::select(DB::raw('count(id) as jumlah_dosen'),'jenis_kelamin')->groupBy('jenis_kelamin')->get();
        $grafikPerGolongan = Dosen::select(DB::raw('count(id) as jumlah_dosen'),'golongan')->groupBy('golongan')->get();

        // data grafik tendik
        $grafikPerUnit  =   Tendik::with('unit')->select(DB::raw('count(id) as jumlah_tendik'),'unit_id')->groupBy('unit_id')->get();
        $grafikTendikPerGolongan  =   Tendik::select(DB::raw('count(id) as jumlah_tendik'),'golongan')->groupBy('golongan')->get();
        $grafikTendikPerPangkat  =   Tendik::select(DB::raw('count(id) as jumlah_tendik'),'pangkat')->groupBy('pangkat')->get();
        $grafikTendikPerKelas  =   Tendik::select(DB::raw('count(id) as jumlah_tendik'),'kelas_jabatan')->groupBy('kelas_jabatan')->get();
        return view('lpmpp.dashboard',[
            'grafikPerFakultas' =>  $grafikPerFakultas,
            'grafikPerJabatan' =>  $grafikPerJabatan,
            'grafikPerGolongan' =>  $grafikPerGolongan,
            'grafikPerJk' =>  $grafikPerJk,
            'grafikPerGolongan' =>  $grafikPerGolongan,

            'grafikPerUnit'     =>  $grafikPerUnit,
            'grafikTendikPerGolongan'     =>  $grafikTendikPerGolongan,
            'grafikTendikPerPangkat'     =>  $grafikTendikPerPangkat,
            'grafikTendikPerKelas'     =>  $grafikTendikPerKelas,
        ]);
    }
}
