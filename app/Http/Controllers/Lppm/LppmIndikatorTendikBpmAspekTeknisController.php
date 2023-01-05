<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\KriteriaTendikBpmAspekTeknis;
use App\Models\IndikatorTendikBpmAspekTeknis;

use Illuminate\Http\Request;

class LppmIndikatorTendikBpmAspekTeknisController extends Controller
{
    public function index()
    {
        $indikators = IndikatorTendikBpmAspekTeknis::all();
        return view('lpmpp/IndikatorTendikBpmAspekTeknis.index', compact('indikators'));
    }

    public function add()
    {
        $bab = KriteriaTendikBpmAspekTeknis::select('id', 'kriteria')->get();
        return view('lpmpp/IndikatorTendikBpmAspekTeknis.add', compact('bab'));
    }

    public function post(Request $request)
    {
        $attributes = [
            'kriteria_aspek_teknis_id'    =>  'Kriteria Aspek Teknis',
            'indikator'    =>  'Indikator',
        ];
        $this->validate($request, [
            'kriteria_aspek_teknis_id'         => 'required',
            'indikator'         => 'required',
        ], $attributes);

        $unit = IndikatorTendikBpmAspekTeknis::create([
            'kriteria_aspek_teknis_id'         =>  $request->kriteria_aspek_teknis_id,
            'indikator'    =>  $request->indikator,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Indikator Penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.IndikatorTendikBpmAspekTeknis')->with($notification);
    }
    public function edit($id)
    {
        $data = IndikatorTendikBpmAspekTeknis::where('id', $id)->first();
        $bab = KriteriaTendikBpmAspekTeknis::select('id', 'nama_bab')->get();

        return view('lpmpp/IndikatorTendikBpmAspekTeknis.edit', compact('data', 'bab'));
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

        IndikatorTendikBpmAspekTeknis::where('id', $id)->update([
            'bab_indikator_ban_pt_dosen_id'         =>  $request->nama_bab,
            'indikator'    =>  $request->indikator,
            'skor'    =>  $request->skor,
            'keterangan'    =>  $request->keterangan,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Indikator Penilaian berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.IndikatorTendikBpmAspekTeknis')->with($notification);
    }
    public function delete($id)
    {
        IndikatorTendikBpmAspekTeknis::where('id', $id)->delete();
        $notification = array(
            'message' => ' data Indikator Penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.IndikatorTendikBpmAspekTeknis')->with($notification);
    }
}
