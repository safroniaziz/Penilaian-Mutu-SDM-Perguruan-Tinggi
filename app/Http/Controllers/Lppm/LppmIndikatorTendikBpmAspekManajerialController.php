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
        $indikators = IndikatorTendikBpmAspekManajerial::all();
        return view('lpmpp/IndikatorTendikBpmAspekManajerial.index', compact('indikators'));
    }

    public function add()
    {
        $bab = KriteriaTendikBpmAspekManajerial::select('id', 'kriteria')->get();
        return view('lpmpp/IndikatorTendikBpmAspekManajerial.add', compact('bab'));
    }

    public function post(Request $request)
    {
        $attributes = [
            'kriteria_aspek_manajerial_id'    =>  'Kriteria Aspek Manajerial',
            'indikator'    =>  'Indikator',
        ];
        $this->validate($request, [
            'kriteria_aspek_manajerial_id'         => 'required',
            'indikator'         => 'required',
        ], $attributes);

        $unit = IndikatorTendikBpmAspekManajerial::create([
            'kriteria_aspek_manajerial_id'         =>  $request->kriteria_aspek_manajerial_id,
            'indikator'    =>  $request->indikator,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Indikator Penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.IndikatorTendikBpmAspekManajerial')->with($notification);
    }
    public function edit($id)
    {
        $data = IndikatorTendikBpmAspekManajerial::where('id', $id)->first();
        $bab = KriteriaTendikBpmAspekManajerial::select('id', 'nama_bab')->get();

        return view('lpmpp/IndikatorTendikBpmAspekManajerial.edit', compact('data', 'bab'));
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
        return redirect()->route('lpmpp.IndikatorTendikBpmAspekManajerial')->with($notification);
    }
    public function delete($id)
    {
        IndikatorTendikBpmAspekManajerial::where('id', $id)->delete();
        $notification = array(
            'message' => ' data Indikator Penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.IndikatorTendikBpmAspekManajerial')->with($notification);
    }
}
