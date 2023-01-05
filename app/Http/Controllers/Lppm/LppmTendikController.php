<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\Tendik;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class LppmTendikController extends Controller
{
    public function index(){
        $tendiks = Tendik::with('unit')->get();
        $grafikJumlahTendik = Unit::with('tendiks')->get();
        return view('lpmpp/tendik.index',compact('tendiks','grafikJumlahTendik'));
    }

    public function add(){
        $units = Unit::all();
        return view('lpmpp/tendik.add',[
            'units' => $units,
        ]);
    }

    public function post(Request $request){
        $attributes = [
            'unit_id'               =>  'Nama Unit Kerja',
            'nama_lengkap'          =>  'Nama Lengkap',
            'nip'                   =>  'Nip',
            'password'              =>  'Password',
        ];
        $this->validate($request, [
            'unit_id'               =>'required',
            'nama_lengkap'          =>'required',
            'nip'                   =>'required|numeric',
            'password'              =>'required',
        ],$attributes);

        User::create([
            'unit_id'             =>  $request->unit_id,
            'nama_lengkap'          =>  $request->nama_lengkap,
            'nip'                   =>  $request->nip,
            'password'              =>  bcrypt($request->password),
            'akses'                 =>  'tendik',
        ]);

        $notification = array(
            'message' => 'Berhasil, data tendik berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.tendik')->with($notification);
    }
    public function edit($id){
        $units = Unit::all();
        $data = User::where('id',$id)->first();
        return view('lpmpp/tendik.edit',[
            'units' => $units,
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id){
        $attributes = [
            'unit_id'               =>  'Nama Unit Kerja',
            'nama_lengkap'          =>  'Nama Lengkap',
            'nip'                   =>  'Nip',
        ];
        $this->validate($request, [
            'unit_id'               =>'required',
            'nama_lengkap'          =>'required',
            'nip'                   =>'required|numeric',
        ],$attributes);

        User::where('id',$id)->update([
            'unit_id'             =>  $request->unit_id,
            'nama_lengkap'          =>  $request->nama_lengkap,
            'nip'                   =>  $request->nip,
            'akses'                 =>  'tendik',
        ]);

        $notification = array(
            'message' => 'Berhasil, data tendik berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.tendik')->with($notification);
    }
    public function delete($id){
        User::where('id',$id)->delete();
        $notification = array(
            'message' => ' data tendik berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.tendik')->with($notification);
    }
}
