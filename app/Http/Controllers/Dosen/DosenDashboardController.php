<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DosenDashboardController extends Controller
{
    public function dashboard(Request $request){
        $nip =  Session::get('nip');
        $dosen = Dosen::with(['dosenRiwayatGolongan','dosenPa'])->where('id',$nip)->first();
        if (empty($dosen)) {
            Session::flush();
            return redirect()->route('login')->with(['error'    =>  'Mohon maaf data anda belum terdaftar di aplikasi ini']);
        }
        Session::put('dosen',$dosen);
        return view('dosen.dashboard',[
            'dosen' =>  $dosen,
        ]);
    }
}
