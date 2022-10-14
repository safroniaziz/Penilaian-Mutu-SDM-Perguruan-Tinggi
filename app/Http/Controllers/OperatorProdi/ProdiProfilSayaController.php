<?php

namespace App\Http\Controllers\OperatorProdi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdiProfilSayaController extends Controller
{
    public function index(){
        $data = User::where('id',Auth::user()->id)->get();
        return view('operator_prodi/profil.index',[
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id){
        $messages = [
            'required'      => ':attribute harus diisi',
            'numeric'       => ':attribute harus berisi angka',
        ];
        $attributes = [
            'nama_lengkap'      =>  'Username',
            'nip'     =>  'Nama Lengkap',
        ];
        $this->validate($request,[
            'nama_lengkap'      =>  'required',
            'nip'     =>  'required',
        ],$messages,$attributes);

        $array = [
            'nama_lengkap'      =>  $request->nama_lengkap,
            'nip'     =>  $request->nip,
        ];

        User::where('id',$id)->update($array);
        $notification = array(
            'message' => 'Berhasil, data profil berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_prodi.profil')->with($notification);
    }
    public function ubahPassword(Request $request){
        // return $request->all();

        User::where('id',Auth::user()->id)->update([
            'password'  =>  bcrypt($request->password_ubah),
        ]);

        $notification = array(
            'message' => 'Berhasil, password login berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_prodi.profil')->with($notification);
    }
}
