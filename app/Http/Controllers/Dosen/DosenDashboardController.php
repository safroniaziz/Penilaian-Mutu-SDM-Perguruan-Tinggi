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
        $dosen = Dosen::where('nip',$nip)->first();
        return $dosen;
        return view('dosen.dashboard',[

        ]);
    }
}
