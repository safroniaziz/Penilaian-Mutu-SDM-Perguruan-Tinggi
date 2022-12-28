<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\IkkPimpinan;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasIkuController extends Controller
{
    public function index(){
        $fakultas = Unit::find(Auth::user()->unit_id);
        $ikus = IkkPimpinan::with('unit')->where('unit_id',Auth::user()->unit_id)->get();
        return view('operator_fakultas.iku.index',[
            'ikus'  =>  $ikus,
            'fakultas'  =>  $fakultas,
        ]);
    }
}
