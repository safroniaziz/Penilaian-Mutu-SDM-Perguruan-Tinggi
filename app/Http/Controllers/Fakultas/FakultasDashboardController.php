<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasDashboardController extends Controller
{
    public function dashboard(){
        $fakultas = Unit::findOrFail(Auth::user()->unit_id);
        return view('operator_fakultas.dashboard',[
            'fakultas'  =>  $fakultas,
        ]);
    }
}
