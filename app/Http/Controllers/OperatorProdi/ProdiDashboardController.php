<?php

namespace App\Http\Controllers\OperatorProdi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdiDashboardController extends Controller
{
    public function dashboard(){
        return view('operator_prodi.dashboard');
    }
}
