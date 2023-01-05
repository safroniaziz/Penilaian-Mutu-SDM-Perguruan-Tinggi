<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\KriteriaTendikBpmAspekTeknis;
use Illuminate\Http\Request;

class LppmKriteriaTendikBpmAspekTeknisController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaTendikBpmAspekTeknis::select('id', 'kriteria')->get();
        return view('lpmpp/KriteriaTendikBpmAspekTeknis.index', compact('kriteria'));
    }

    public function add()
    {
        return view('lpmpp/KriteriaTendikBpmAspekTeknis.add');
    }

    public function post(Request $request)
    {
        $attributes = [
            'kriteria'         =>  'Nama Kriteria Aspek Teknis',
        ];
        $this->validate($request, [
            'kriteria'         => 'required',
        ], $attributes);

        $bab = KriteriaTendikBpmAspekTeknis::create([
            'kriteria'         =>  $request->kriteria,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Kriteria Aspek Teknis berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.KriteriaTendikBpmAspekTeknis')->with($notification);
    }
    public function edit($id)
    {
        $data = KriteriaTendikBpmAspekTeknis::where('id', $id)->first();
        return view('lpmpp/KriteriaTendikBpmAspekTeknis.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $attributes = [
            'kriteria'         =>  'Kriteria Aspek Teknis',
        ];
        $this->validate($request, [
            'kriteria'         => 'required',
        ], $attributes);

        KriteriaTendikBpmAspekTeknis::where('id', $id)->update([
            'kriteria'             =>  $request->kriteria,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Kriteria Aspek Teknis berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.KriteriaTendikBpmAspekTeknis')->with($notification);
    }
    public function delete($id)
    {
        KriteriaTendikBpmAspekTeknis::where('id', $id)->delete();
        $notification = array(
            'message' => ' data Bab Indikator Penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.KriteriaTendikBpmAspekTeknis')->with($notification);
    }
}
