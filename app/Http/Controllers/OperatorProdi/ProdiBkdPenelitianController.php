<?php

namespace App\Http\Controllers\OperatorProdi;

use App\Http\Controllers\Controller;
use App\Models\BkdPenelitian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdiBkdPenelitianController extends Controller
{
    public function index(){
        if (!empty(session('dosen'))) {
            $datas = BkdPenelitian::where('dosen_id',session('dosen'))->orderBy('created_at','desc')->get();
        }else {
            $datas = BkdPenelitian::orderBy('created_at','desc')->get();
        }
        $dosens = User::where('prodi_id',Auth::user()->prodi_id)->where('akses','dosen')->get();
        return view('operator_prodi/bkd_penelitian.index',[
            'dosens'    =>  $dosens,
            'datas'     =>  $datas,
        ]);
    }

    public function add(){
        if (empty(session('dosen'))) {
            $notification = array(
                'message' => 'Gagal, silahkan pilih dosen terlebih dahulu!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $dosen = User::findOrFail(session('dosen'));
        return view('operator_prodi/bkd_penelitian.add',[
            'dosen' => $dosen,
        ]);
    }

    public function post(Request $request){
        $attributes = [

            'indikator'             =>  'Jenis Kegiatan',
            'sasaran_strategis'     =>  'Bukti Penugasan',
            'ukuran_kinerja'        =>  'Sks Beban Kerja',
            'target'                =>  'Masa Pelaksanaan Tugas',
            'bukti_dokumen'         =>  'Bukti Dokumen',
            'persentase_capaian'    =>  'Persentase Capaian',
            'sks_kinerja'           =>  'Sks Capaian Kinerja',
        ];
        $this->validate($request, [
            'indikator'             =>  'required',
            'sasaran_strategis'     =>  'required',
            'ukuran_kinerja'        =>  'required',
            'target'                =>  'required',
        ],$attributes);

        KeyPerformanceIndikator::create([
            'dosen_id'              =>$request->dosen_id,
            'indikator'             =>$request->indikator,
            'sasaran_strategis'     =>$request->sasaran_strategis,
            'ukuran_kinerja'        =>$request->ukuran_kinerja,
            'target'                =>$request->target,
        ]);

        $notification = array(
            'message' => 'Berhasil, data berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route()->back()->with($notification);
    }

    public function edit($id){
        if (empty(session('dosen'))) {
            $notification = array(
                'message' => 'Gagal, silahkan pilih dosen terlebih dahulu!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $dosen = User::findOrFail(session('dosen'));
        $data = BkdPenelitian::where('id',$id)->first();
        return view('operator_prodi/bkd_penelitian.edit',[
            'dosen' => $dosen,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id){
        $attributes = [
            'jenis_kegiatan'        =>  'Jenis Kegiatan',
            'bukti_penugasan'       =>  'Bukti Penugasan',
            'sks_beban_kerja'       =>  'Sks Beban Kerja',
            'masa_tugas'            =>  'Masa Pelaksanaan Tugas',
            'bukti_dokumen'         =>  'Bukti Dokumen',
            'persentase_capaian'    =>  'Persentase Capaian',
            'sks_kinerja'           =>  'Sks Capaian Kinerja',
        ];
        $this->validate($request, [
            'jenis_kegiatan'        =>  'required',
            'bukti_penugasan'       =>  'required',
            'sks_beban_kerja'       =>  'required',
            'masa_tugas'            =>  'required',
            'bukti_dokumen'         =>  'required',
            'persentase_capaian'    =>  'required',
            'sks_kinerja'           =>  'required',
        ],$attributes);

        BkdPenelitian::where('id',$id)->update([
            'jenis_kegiatan'        =>$request->jenis_kegiatan,
            'bukti_penugasan'       =>$request->bukti_penugasan,
            'sks_beban_kerja'       =>$request->sks_beban_kerja,
            'masa_tugas'            =>$request->masa_tugas,
            'bukti_dokumen'         =>$request->bukti_dokumen,
            'persentase_capaian'    =>$request->persentase_capaian,
            'sks_kinerja'           =>$request->sks_kinerja,
        ]);

        $notification = array(
            'message' => 'Berhasil, data bkd penelitian'.$request->nama_dosen. 'berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_prodi.bkd_penelitian')->with($notification);
    }
    public function delete($id){
        BkdPenelitian::where('id',$id)->delete();
        $notification = array(
            'message' => ' data bkd penelitian dosen berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_prodi.bkd_penelitian')->with($notification);
    }

    public function pilihDosen(Request $request){
        $attributes = [
            'dosen_id'          =>  'Nama Dosen',
        ];
        $this->validate($request, [
            'dosen_id'      =>'required',
        ],$attributes);

        $dosen = session('dosen');
        $user = User::where('id',$request->dosen_id)->first();
        $dosen = [
            'dosen_id'     => $user->id,
        ];
        session(['dosen' =>  $dosen['dosen_id']]);
        return redirect()->route('operator_prodi.bkd_penelitian');
    }
}
