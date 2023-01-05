<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\IkkPimpinan;
use App\Models\IkkPimpinanDetail;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FakultasIkuController extends Controller
{
    public function index(){
        $fakultas = Unit::find(Auth::user()->unit_id);
        $ikus = IkkPimpinan::with('unit')->where('unit_id',Auth::user()->unit_id)->get();
        return view('operator_fakultas.iku.index',[
            'ikus'  =>  $ikus,
            'fakultas'  =>  $fakultas,
        ]);
    }

    public function add(){
        return view('operator_fakultas.iku.add');
    }


    public function post(Request $request){
        $rules = [
            'judul_ikk'             =>  'required',
            'keterangan_ikk'        =>  'required',
        ];
        $text = [
            'judul_ikk.required'        =>  'Judul harus diisi',
            'keterangan_ikk.required'   =>  'Keterangan harus diisi',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            $notification = array(
                'message' => $validasi->errors()->first(),
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }

        $simpan = IkkPimpinan::create([
            'unit_id'                   =>  Auth::user()->unit_id,
            'judul_ikk'                 =>  $request->judul_ikk,
            'keterangan_ikk'            =>  $request->keterangan_ikk,
        ]);

        if ($simpan) {
            $notification = array(
                'message' => 'IKK Pimpinan Berhasil Disimpan',
                'alert-type' => 'success',
            );
            return redirect()->route('operator_fakultas.iku')->with($notification);
        }
    }

    public function edit(IkkPimpinan $ikk){
        return view('operator_fakultas.iku.edit',[
            'ikk'   =>  $ikk,
        ]);
    }

    public function update(Request $request, IkkPimpinan $ikk){
        $rules = [
            'judul_ikk'             =>  'required',
            'keterangan_ikk'        =>  'required',
        ];
        $text = [
            'judul_ikk.required'        =>  'Judul harus diisi',
            'keterangan_ikk.required'   =>  'Keterangan harus diisi',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            $notification = array(
                'message' => $validasi->errors()->first(),
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }

        $update = $ikk->update([
            'judul_ikk'                 =>  $request->judul_ikk,
            'keterangan_ikk'            =>  $request->keterangan_ikk,
        ]);

        if ($update) {
            $notification = array(
                'message' => 'IKK Pimpinan Berhasil Diubah',
                'alert-type' => 'success',
            );
            return redirect()->route('operator_fakultas.iku')->with($notification);
        }
    }

    public function delete(IkkPimpinan $ikk){
        $delete = $ikk->delete();
        if ($delete) {
            $notification = array(
                'message' => 'IKK Pimpinan Berhasil Dihapus',
                'alert-type' => 'success',
            );
            return redirect()->route('operator_fakultas.iku')->with($notification);
        }
    }
}