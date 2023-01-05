<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\KriteriaTendikBpmAspekManajerial;

use Illuminate\Http\Request;

class LppmKriteriaTendikBpmAspekManajerialController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaTendikBpmAspekManajerial::select('id', 'kriteria')->get();
        return view('lpmpp/KriteriaTendikBpmAspekManajerial.index', compact('kriteria'));
    }

    public function add()
    {
        return view('lpmpp/KriteriaTendikBpmAspekManajerial.add');
    }

    public function post(Request $request)
    {
        $attributes = [
            'kriteria'         =>  'Nama Kriteria Aspek Manajerial',
        ];
        $this->validate($request, [
            'kriteria'         => 'required',
        ], $attributes);

        $bab = KriteriaTendikBpmAspekManajerial::create([
            'kriteria'         =>  $request->kriteria,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Kriteria Aspek Manajerial berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.KriteriaTendikBpmAspekManajerial')->with($notification);
    }
    public function edit($id)
    {
        $data = KriteriaTendikBpmAspekManajerial::where('id', $id)->first();
        return view('lpmpp/KriteriaTendikBpmAspekManajerial.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $attributes = [
            'kriteria'         =>  'Kriteria Aspek Manajerial',
        ];
        $this->validate($request, [
            'kriteria'         => 'required',
        ], $attributes);

        KriteriaTendikBpmAspekManajerial::where('id', $id)->update([
            'kriteria'             =>  $request->kriteria,
        ]);

        $notification = array(
            'message' => 'Berhasil, data Kriteria Aspek Manajerial berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.KriteriaTendikBpmAspekManajerial')->with($notification);
    }
    public function delete($id)
    {
        KriteriaTendikBpmAspekManajerial::where('id', $id)->delete();
        $notification = array(
            'message' => ' data Kriteria Aspek Manajerial berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.KriteriaTendikBpmAspekManajerial')->with($notification);
    }
}
