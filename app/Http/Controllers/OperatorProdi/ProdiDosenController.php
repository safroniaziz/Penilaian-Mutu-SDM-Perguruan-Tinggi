<?php

namespace App\Http\Controllers\OperatorProdi;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdiDosenController extends Controller
{
    public function index(){
        $dosens = User::join('prodis','prodis.id','users.prodi_id')
                        ->join('units','units.id','prodis.fakultas_id')
                        ->select('users.id','nama_lengkap','nip','nidn','nama_prodi','nama_unit as nama_fakultas')
                        ->where('akses','dosen')
                        ->where('prodi_id',Auth::user()->prodi_id)
                        ->orderBy('users.id','desc')
                        ->paginate(10);
        return view('operator_prodi/dosen.index',compact('dosens'));
    }

    public function add(){
        return view('operator_prodi/dosen.add');
    }

    public function post(Request $request){
        $attributes = [
            'nama_lengkap'      =>  'Nama Lengkap',
            'nip'               =>  'Nip',
            'nidn'              =>  'NIDN',
        ];
        $this->validate($request, [
            'nama_lengkap'      =>'required',
            'nip'               =>'required|numeric',
            'nidn'              =>'required|numeric',
        ],$attributes);

        User::create([
            'prodi_id'          =>  Auth::user()->prodi_id,
            'nama_lengkap'      =>  $request->nama_lengkap,
            'nip'               =>  $request->nip,
            'nidn'              =>  $request->nidn,
            'akses'             =>  'dosen',
        ]);

        $notification = array(
            'message' => 'Berhasil, data dosen berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_prodi.dosen')->with($notification);
    }
    public function edit($id){
        $data = User::where('id',$id)->first();
        return view('operator_prodi/dosen.edit',[
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id){
        $attributes = [
            'nama_lengkap'      =>  'Nama Lengkap',
            'nip'               =>  'Nip',
            'nidn'              =>  'NIDN',
        ];
        $this->validate($request, [
            'nama_lengkap'      =>'required',
            'nip'               =>'required|numeric',
            'nidn'              =>'required|numeric',
        ],$attributes);

        User::where('id',$id)->update([
            'nama_lengkap'      =>  $request->nama_lengkap,
            'nip'               =>  $request->nip,
            'nidn'              =>  $request->nidn,
        ]);

        $notification = array(
            'message' => 'Berhasil, data dosen berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_prodi.dosen')->with($notification);
    }
    public function delete($id){
        User::where('id',$id)->delete();
        $notification = array(
            'message' => ' data dosen berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_prodi.dosen')->with($notification);
    }
}
