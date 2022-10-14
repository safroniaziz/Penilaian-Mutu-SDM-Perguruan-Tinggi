<?php

namespace App\Http\Controllers\OperatorUnit;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitProdiController extends Controller
{
    public function index(){
        $prodis = Prodi::all();
        return view('operator_unit/prodi.index',compact('prodis'));
    }

    public function add(){
        $fakultas = Unit::where('jenis_unit','fakultas')->get();
        return view('operator_unit/prodi.add',[
            'fakultas' => $fakultas,
        ]);
    }

    public function post(Request $request){
        $attributes = [
            'fakultas_id'           =>  'Nama Fakultas',
            'nama_prodi'            =>  'Nama Program Studi',
            'jumlah_mahasiswa'      =>  'Jumlah Mahasiswa',
            'jumlah_prodi'          =>  'Jumlah Dosen',
        ];
        $this->validate($request, [
            'fakultas_id'           =>'required',
            'nama_prodi'              =>'required',
            'jumlah_prodi'          =>'numeric',
        ],$attributes);

        Prodi::create([
            'fakultas_id'           =>  $request->fakultas_id,
            'nama_prodi'              =>  $request->nama_prodi,
            'jumlah_mahasiswa'      =>  $request->jumlah_mahasiswa,
            'jumlah_prodi'          =>  $request->jumlah_dosen
        ]);

        $notification = array(
            'message' => 'Berhasil, data prodi berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.prodi')->with($notification);
    }
    public function edit($id){
        $fakultas = Unit::where('jenis_unit','fakultas')->get();
        $data = Prodi::where('id',$id)->first();
        return view('operator_unit/prodi.edit',[
            'fakultas' => $fakultas,
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id){
        $attributes = [
            'fakultas_id'           =>  'Nama Fakultas',
            'nama_prodi'            =>  'Nama Program Studi',
            'jumlah_mahasiswa'      =>  'Jumlah Mahasiswa',
            'jumlah_dosen'          =>  'Jumlah Dosen',
        ];
        $this->validate($request, [
            'fakultas_id'           =>'required',
            'nama_prodi'              =>'required',
        ],$attributes);

        Prodi::where('id',$id)->update([
            'fakultas_id'           =>  $request->fakultas_id,
            'nama_prodi'              =>  $request->nama_prodi,
            'jumlah_mahasiswa'      =>  $request->jumlah_mahasiswa,
            'jumlah_dosen'          =>  $request->jumlah_dosen
        ]);

        $notification = array(
            'message' => 'Berhasil, data prodi berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.prodi')->with($notification);
    }
    public function delete($id){
        Prodi::where('id',$id)->delete();
        $notification = array(
            'message' => ' data prodi berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.fakultas')->with($notification);
    }
}
