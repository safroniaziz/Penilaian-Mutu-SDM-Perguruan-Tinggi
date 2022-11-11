<?php

namespace App\Http\Controllers\OperatorUnit;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitTendikController extends Controller
{
    public function index(){
        $tendiks = User::join('units','units.id','users.unit_id')
                        ->select('users.id','nama_lengkap','nip','pangkat','golongan','nama_unit')
                        ->where('akses','tendik')
                        ->where('unit_id',Auth::user()->unit_id)
                        ->orderBy('users.id','desc')
                        ->paginate(10);
        return view('operator_unit/tendik.index',compact('tendiks'));
    }

    public function add(){
        return view('operator_unit/tendik.add');
    }

    public function post(Request $request){
        $attributes = [
            'nama_lengkap'          =>  'Nama Lengkap',
            'nip'                   =>  'Nip',
            'pangkat'               =>  'Pangkat',
            'golongan'              =>  'Golongan',
        ];
        $this->validate($request, [
            'nama_lengkap'      =>'required',
            'nip'               =>'required|numeric',
            'pangkat'           =>'required',
            'golongan'          =>'required',
        ],$attributes);

        User::create([
            'unit_id'          =>  Auth::user()->unit_id,
            'nama_lengkap'      =>  $request->nama_lengkap,
            'nip'               =>  $request->nip,
            'pangkat'           =>  $request->pangkat,
            'golongan'          =>  $request->golongan,
            'akses'             =>  'tendik',
        ]);

        $notification = array(
            'message' => 'Berhasil, data tendik berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.tendik')->with($notification);
    }
    public function edit($id){
        $data = User::where('id',$id)->first();
        return view('operator_unit/tendik.edit',[
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id){
        $attributes = [
            'nama_lengkap'          =>  'Nama Lengkap',
            'nip'                   =>  'Nip',
            'pangkat'               =>  'Pangkat',
            'golongan'              =>  'Golongan',
        ];
        $this->validate($request, [
            'nama_lengkap'      =>'required',
            'nip'               =>'required|numeric',
            'pangkat'           =>'required',
            'golongan'          =>'required',
        ],$attributes);

        User::where('id',$id)->update([
            'nama_lengkap'      =>  $request->nama_lengkap,
            'nip'               =>  $request->nip,
            'pangkat'           =>  $request->pangkat,
            'golongan'          =>  $request->golongan,
        ]);

        $notification = array(
            'message' => 'Berhasil, data tendik berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.tendik')->with($notification);
    }
    public function delete($id){
        User::where('id',$id)->delete();
        $notification = array(
            'message' => ' data tendik berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.tendik')->with($notification);
    }
}
