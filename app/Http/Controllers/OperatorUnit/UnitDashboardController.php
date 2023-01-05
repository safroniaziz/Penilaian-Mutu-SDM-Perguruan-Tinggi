<?php

namespace App\Http\Controllers\OperatorUnit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitDashboardController extends Controller
{
    public function dashboard(){
        return view('operator_unit.dashboard');
    }
}
