<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\BabIndikatorBanPtDosen;
use App\Models\IndikatorBanPtDosen;
use Illuminate\Http\Request;

class LppmIndikatorPenilaianController extends Controller
{
    public function index()
    {
        $indikator = IndikatorBanPtDosen::select('indikator_ban_pt_dosens.id', 'bab_indikator_ban_pt_dosens.nama_bab', 'indikator', 'keterangan', 'skor')->join('bab_indikator_ban_pt_dosens', 'bab_indikator_ban_pt_dosens.id', '=', 'indikator_ban_pt_dosens.bab_indikator_ban_pt_dosen_id')->get();
        return view('lpmpp/indikator.index', compact('indikator'));
    }

    public function add()
    {
        $bab = BabIndikatorBanPtDosen::select('id', 'nama_bab')->get();
        return view('lpmpp/indikator.add', compact('bab'));
    }

    public function post(Request $request)
    {
        $attributes = [
            'nama_bab'         =>  'Nama Bab Indikator Penilaian',
            'indikator'    =>  'Indikator',
            // 'skor'    =>  'Skor',
            'keterangan'    =>  'Keterangan',
        ];
        $this->validate($request, [
            'nama_bab'         => 'required',
            'indikator'         => 'required',
            // 'skor'         => 'required',
            'keterangan'         => 'required',
        ], $attributes);

        $unit = IndikatorBanPtDosen::create([
            'bab_indikator_ban_pt_dosen_id'         =>  $request->nama_bab,
            'indikator'    =>  $request->indikator,
            // 'skor'    =>  $request->skor,
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
        $data = IndikatorBanPtDosen::where('id', $id)->first();
        $bab = BabIndikatorBanPtDosen::select('id', 'nama_bab')->get();

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

        IndikatorBanPtDosen::where('id', $id)->update([
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
        IndikatorBanPtDosen::where('id', $id)->delete();
        $notification = array(
            'message' => ' data Indikator Penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.indikator')->with($notification);
    }
}
