<?php

namespace App\Http\Controllers\Tendik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TendikDashboardController extends Controller
{
    public function dashboard(){
        return view('tendik.dashboard');
    }
}
