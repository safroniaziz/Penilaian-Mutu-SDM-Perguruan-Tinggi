<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class LppmFakultasController extends Controller
{
    public function index(){
        $unit = Unit::select('id','nama_unit','nama_singkatan')->where('jenis_unit', 'fakultas')->get();
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

        Unit::create([
            'nama_unit'         =>  $request->nama_unit,
            'nama_singkatan'    =>  $request->nama_singkatan,
            'jenis_unit'        =>  'fakultas',
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
        Unit::where('id',$id)->update([
            'nama_unit'             =>  $request->nama_unit,
            'nama_singkatan'        =>  $request->nama_singkatan,
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
}
