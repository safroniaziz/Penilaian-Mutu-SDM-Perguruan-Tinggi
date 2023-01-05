<?php

namespace App\Http\Controllers;

use App\Models\IndikatorTendikBanPt;
use Illuminate\Http\Request;

class IndikatorTendikBanPtController extends Controller
{
    public function index()
    {
        $indikators = IndikatorTendikBanPt::all();
        return view('lpmpp/IndikatorTendikBanPt.index', compact('indikators'));
    }

    public function add()
    {
        return view('lpmpp/IndikatorTendikBanPt.add');
    }

    public function post(Request $request)
    {
        $attributes = [
            'indikator'    =>  'Indikator',
        ];
        $this->validate($request, [
            'indikator'         => 'required',
        ], $attributes);

        $unit = IndikatorTendikBanPt::create([
            'indikator'    =>  $request->indikator,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Indikator Penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.tendik_ban_pt')->with($notification);
    }
   
    public function delete($id)
    {
        IndikatorTendikBanPt::where('id', $id)->delete();
        $notification = array(
            'message' => ' data Indikator Penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.tendik_ban_pt')->with($notification);
    }
}
