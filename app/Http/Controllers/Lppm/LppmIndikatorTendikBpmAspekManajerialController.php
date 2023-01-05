<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KriteriaTendikBpmAspekManajerial;
use App\Models\IndikatorTendikBpmAspekManajerial;

class LppmIndikatorTendikBpmAspekManajerialController extends Controller
{
    public function index()
    {
        $indikator = IndikatorTendikBpmAspekManajerial::select('indikator_ban_pt_dosens.id', 'bab_indikator_ban_pt_dosens.nama_bab', 'indikator', 'keterangan', 'skor')->join('bab_indikator_ban_pt_dosens', 'bab_indikator_ban_pt_dosens.id', '=', 'indikator_ban_pt_dosens.bab_indikator_ban_pt_dosen_id')->get();
        return view('lpmpp/indikator.index', compact('indikator'));
    }

    public function add()
    {
        $bab = KriteriaTendikBpmAspekManajerial::select('id', 'nama_bab')->get();
        return view('lpmpp/indikator.add', compact('bab'));
    }

    public function post(Request $request)
    {
        $attributes = [
            'nama_bab'         =>  'Nama Bab Indikator Penilaian',
            'indikator'    =>  'Indikator',
            'skor'    =>  'Skor',
            'keterangan'    =>  'Keterangan',
        ];
        $this->validate($request, [
            'nama_bab'         => 'required',
            'indikator'         => 'required',
            'skor'         => 'required',
            'keterangan'         => 'required',
        ], $attributes);

        $unit = IndikatorTendikBpmAspekManajerial::create([
            'bab_indikator_ban_pt_dosen_id'         =>  $request->nama_bab,
            'indikator'    =>  $request->indikator,
            'skor'    =>  $request->skor,
            'keterangan'    =>  $request->keterangan,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Indikator Penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.indikator')->with($notification);
    }
    public function edit($id)
    {
        $data = IndikatorTendikBpmAspekManajerial::where('id', $id)->first();
        $bab = KriteriaTendikBpmAspekManajerial::select('id', 'nama_bab')->get();

        return view('lpmpp/indikator.edit', compact('data', 'bab'));
    }
    public function update(Request $request, $id)
    {
        $attributes = [
            'nama_bab'         =>  'Nama Bab Indikator Penilaian',
            'indikator'    =>  'Indikator',
            'skor'    =>  'Skor',
            'keterangan'    =>  'Keterangan',
        ];
        $this->validate($request, [
            'nama_bab'         => 'required',
            'indikator'         => 'required',
            'skor'         => 'required',
            'keterangan'         => 'required',
        ], $attributes);

        IndikatorTendikBpmAspekManajerial::where('id', $id)->update([
            'bab_indikator_ban_pt_dosen_id'         =>  $request->nama_bab,
            'indikator'    =>  $request->indikator,
            'skor'    =>  $request->skor,
            'keterangan'    =>  $request->keterangan,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Indikator Penilaian berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.indikator')->with($notification);
    }
    public function delete($id)
    {
        IndikatorTendikBpmAspekManajerial::where('id', $id)->delete();
        $notification = array(
            'message' => ' data Indikator Penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.indikator')->with($notification);
    }
}
