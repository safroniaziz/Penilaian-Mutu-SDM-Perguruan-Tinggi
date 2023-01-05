<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\BabIndikatorBanPtDosen;
use Illuminate\Http\Request;

class LppmBabIndikatorPenilaianController extends Controller
{
    public function index()
    {
        $bab = BabIndikatorBanPtDosen::select('id', 'nama_bab')->get();
        return view('lpmpp/babIndikator.index', compact('bab'));
    }

    public function add()
    {
        return view('lpmpp/babIndikator.add');
    }

    public function post(Request $request)
    {
        $attributes = [
            'nama_bab'         =>  'Nama Bab Indikator Penilaian',
        ];
        $this->validate($request, [
            'nama_bab'         => 'required',
        ], $attributes);

        $bab = BabIndikatorBanPtDosen::create([
            'nama_bab'         =>  $request->nama_bab,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Bab Indikator Penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.babIndikator')->with($notification);
    }
    public function edit($id)
    {
        $data = BabIndikatorBanPtDosen::where('id', $id)->first();
        return view('lpmpp/babIndikator.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $attributes = [
            'nama_bab'         =>  'Bab Indikator Penilaian',
        ];
        $this->validate($request, [
            'nama_bab'         => 'required',
        ], $attributes);

        BabIndikatorBanPtDosen::where('id', $id)->update([
            'nama_bab'             =>  $request->nama_bab,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Bab Indikator Penilaian berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.babIndikator')->with($notification);
    }
    public function delete($id)
    {
        BabIndikatorBanPtDosen::where('id', $id)->delete();
        $notification = array(
            'message' => ' data Bab Indikator Penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.babIndikator')->with($notification);
    }
}
