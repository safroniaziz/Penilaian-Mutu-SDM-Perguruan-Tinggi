<?php

namespace App\Http\Controllers\OperatorUnit;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class UnitDosenController extends Controller
{
    public function index(){
        $dosens = User::join('prodis','prodis.id','users.prodi_id')
                        ->join('units','units.id','prodis.fakultas_id')
                        ->select('users.id','nama_lengkap','nip','nidn','nama_prodi','nama_unit as nama_fakultas')
                        ->where('akses','dosen')
                        ->orderBy('users.id','desc')
                        ->paginate(10);
        return view('operator_unit/dosen.index',compact('dosens'));
    }

    public function add(){
        $fakultas = Unit::where('jenis_unit','fakultas')->get();
        return view('operator_unit/dosen.add',[
            'fakultas' => $fakultas,
        ]);
    }

    public function post(Request $request){
        $attributes = [
            'prodi_id'          =>  'Nama Program Studi',
            'nama_lengkap'      =>  'Nama Lengkap',
            'nip'               =>  'Nip',
            'nidn'              =>  'NIDN',
        ];
        $this->validate($request, [
            'prodi_id'          =>'required',
            'nama_lengkap'      =>'required',
            'nip'               =>'required|numeric',
            'nidn'              =>'required|numeric',
        ],$attributes);

        User::create([
            'prodi_id'          =>  $request->prodi_id,
            'nama_lengkap'      =>  $request->nama_lengkap,
            'nip'               =>  $request->nip,
            'nidn'              =>  $request->nidn,
            'akses'             =>  'dosen',
        ]);

        $notification = array(
            'message' => 'Berhasil, data dosen berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.dosen')->with($notification);
    }
    public function edit($id){
        $fakultas = Unit::where('jenis_unit','fakultas')->get();
        $prodis = Prodi::all();
        $data = User::where('id',$id)->first();
        return view('operator_unit/dosen.edit',[
            'fakultas' => $fakultas,
            'prodis' => $prodis,
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id){
        $attributes = [
            'prodi_id'          =>  'Nama Program Studi',
            'nama_lengkap'      =>  'Nama Lengkap',
            'nip'               =>  'Nip',
            'nidn'              =>  'NIDN',
        ];
        $this->validate($request, [
            'prodi_id'          =>'required',
            'nama_lengkap'      =>'required',
            'nip'               =>'required|numeric',
            'nidn'              =>'required|numeric',
        ],$attributes);

        User::where('id',$id)->update([
            'prodi_id'          =>  $request->prodi_id,
            'nama_lengkap'      =>  $request->nama_lengkap,
            'nip'               =>  $request->nip,
            'nidn'              =>  $request->nidn,
            'akses'             =>  'dosen',
        ]);

        $notification = array(
            'message' => 'Berhasil, data dosen berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.dosen')->with($notification);
    }
    public function delete($id){
        User::where('id',$id)->delete();
        $notification = array(
            'message' => ' data dosen berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.dosen')->with($notification);
    }

    public function cariProdi(Request $request){
        $prodis = Prodi::select('id','nama_prodi')->where('fakultas_id',$request->fakultas_id)->get();
        return $prodis;
    }
}
