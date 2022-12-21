<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class LppmUptController extends Controller
{
    public function index(){
        $unit = Unit::select('id','nama_unit','nama_singkatan')->where('jenis_unit', 'upt')->get();
        return view('lpmpp/upt.index',compact('unit'));
    }

    public function add(){
        return view('lpmpp/upt.add');
    }

    public function post(Request $request){
        $attributes = [
            'nama_unit'         =>  'Nama UPT',
            'nama_singkatan'    =>  'Nama Singkatan',
        ];
        $this->validate($request, [
            'nama_unit'         =>'required',
            'nama_singkatan'    =>'required',
        ],$attributes);

        Unit::create([
            'nama_unit'         =>  $request->nama_unit,
            'nama_singkatan'    =>  $request->nama_singkatan,
            'jenis_unit'        =>  'upt',
        ]);

        $notification = array(
            'message' => 'Berhasil, data UPT berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.upt')->with($notification);
    }
    public function edit($id){
        $data = Unit::where('id',$id)->first();
        return view('lpmpp/upt.edit',compact('data'));
    }
    public function update(Request $request, $id){
        $attributes = [
            'nama_unit'         =>  'Nama UPT',
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
            'message' => 'Berhasil, data UPT berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.upt')->with($notification);
    }
    public function delete($id){
        Unit::where('id',$id)->delete();
        $notification = array(
            'message' => ' data UPT berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.upt')->with($notification);
    }
}
