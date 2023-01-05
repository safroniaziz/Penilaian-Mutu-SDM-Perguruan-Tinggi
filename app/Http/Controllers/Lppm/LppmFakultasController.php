<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Tendik;
use App\Models\Unit;
use Illuminate\Http\Request;

class LppmFakultasController extends Controller
{
    public function index(){
        $unit = Unit::select('id','nama_unit','nama_pimpinan','status_pimpinan','nama_singkatan')->where('jenis_unit', 'fakultas')->get();
        return view('lpmpp/fakultas.index',compact('unit'));
    }

    public function add(){
        return view('lpmpp/fakultas.add');
    }

    public function post(Request $request){
        $attributes = [
            'nama_unit'         =>  'Nama Fakultas',
            'nama_singkatan'    =>  'Nama Singkatan',
        ];
        $this->validate($request, [
            'nama_unit'         =>'required',
            'nama_singkatan'    =>'required',
        ],$attributes);
        if ($request->status_pimpinan == "dosen") {
            $pimpinan = Dosen::select('id','nama_dosen as nama_pimpinan','gelar_depan','gelar_belakang')->where('nama_dosen',$request->pimpinan_id)->first();
        }else{
            $pimpinan = Tendik::select('id','nama_tendik as nama_pimpinan','gelar_depan','gelar_belakang')->where('nama_tendik',$request->pimpinan_id)->first();
        }
        $unit = Unit::create([
            'nama_unit'         =>  $request->nama_unit,
            'nama_singkatan'    =>  $request->nama_singkatan,
            'jenis_unit'        =>  'fakultas',
            'pimpinan_id'        =>  $pimpinan->id,
            'nama_pimpinan'        =>  $pimpinan->gelar_depan.''.$pimpinan->nama_pimpinan.''.$pimpinan->gelar_belakang,
            'status_pimpinan'        =>  $request->status_pimpinan,
        ]);

        $notification = array(
            'message' => 'Berhasil, data fakultas berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.fakultas')->with($notification);
    }
    public function edit($id){
        $data = Unit::where('id',$id)->first();
        return view('lpmpp/fakultas.edit',compact('data'));
    }
    public function update(Request $request, $id){
        $attributes = [
            'nama_unit'         =>  'Nama Fakultas',
            'nama_singkatan'    =>  'Nama Singkatan',
        ];
        $this->validate($request, [
            'nama_unit'         =>'required',
            'nama_singkatan'    =>'required',
        ],$attributes);
        if ($request->status_pimpinan == "dosen") {
            $pimpinan = Dosen::select('id','nama_dosen as nama_pimpinan','gelar_depan','gelar_belakang')->where('nama_dosen',$request->pimpinan_id)->first();
        }else{
            $pimpinan = Tendik::select('id','nama_tendik as nama_pimpinan','gelar_depan','gelar_belakang')->where('nama_tendik',$request->pimpinan_id)->first();
        }
        Unit::where('id',$id)->update([
            'nama_unit'             =>  $request->nama_unit,
            'nama_singkatan'        =>  $request->nama_singkatan,
            'pimpinan_id'        =>  $pimpinan->id,
            'nama_pimpinan'        =>  $pimpinan->gelar_depan.' '.$pimpinan->nama_pimpinan.' '.$pimpinan->gelar_belakang,
            'status_pimpinan'        =>  $request->status_pimpinan,
        ]);

        $notification = array(
            'message' => 'Berhasil, data fakultas berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.fakultas')->with($notification);
    }
    public function delete($id){
        Unit::where('id',$id)->delete();
        $notification = array(
            'message' => ' data fakultas berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.fakultas')->with($notification);
    }

    public function cariPimpinan(Request $request){
        if ($request->status_pimpinan == "dosen") {
            $pimpinans = Dosen::select('id','nama_dosen as nama_pimpinan')->get();
        }else{
            $pimpinans = Tendik::select('id','nama_tendik as nama_pimpinan')->get();
        }
        return $pimpinans;
    }
}
