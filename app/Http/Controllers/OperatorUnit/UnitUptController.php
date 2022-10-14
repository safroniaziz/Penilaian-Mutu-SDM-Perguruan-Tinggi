<?php

namespace App\Http\Controllers\OperatorUnit;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitUptController extends Controller
{
    public function index(){
        $unit = Unit::select('id','nama_unit')->where('jenis_unit', 'upt')->get();
        return view('operator_unit/upt.index',compact('unit'));
    }

    public function add(){
        return view('operator_unit/upt.add');
    }

    public function post(Request $request){
        $attributes = [
            'nama_unit'   =>  'Nama unit',
        ];
        $this->validate($request, [
            'nama_unit'    =>'required',
        ],$attributes);

        Unit::create([
            'nama_unit'              =>  $request->nama_unit,
            'jenis_unit'    => 'upt',
        ]);

        $notification = array(
            'message' => 'Berhasil, data unit berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.upt')->with($notification);
    }
    public function edit($id){
        $data = Unit::where('id',$id)->first();
        return view('operator_unit/upt.edit',compact('data'));
    }
    public function update(Request $request, $id){
        $attributes = [
            'nama_unit'   =>  'Pertanyaan',
        ];
        $this->validate($request, [
            'nama_unit'    =>'required',
        ],$attributes);

        Unit::where('id',$id)->update([
            'nama_unit'              =>  $request->nama_unit,
        ]);

        $notification = array(
            'message' => 'Berhasil, data unit berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.upt')->with($notification);
    }
    public function delete($id){
        Unit::where('id',$id)->delete();
        $notification = array(
            'message' => ' data unit berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.upt')->with($notification);
    }
}
