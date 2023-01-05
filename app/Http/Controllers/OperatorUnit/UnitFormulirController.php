<?php

namespace App\Http\Controllers\OperatorUnit;

use App\Http\Controllers\Controller;
use App\Models\FormulirSkpTendik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitFormulirController extends Controller
{
    public function index(){
        if (!empty(session('tendik'))) {
            $datas = FormulirSkpTendik::where('tendik_id',session('tendik'))->orderBy('created_at','desc')->get();
        }else {
            $datas = FormulirSkpTendik::orderBy('created_at','desc')->get();
        }
        $tendiks = User::where('prodi_id',Auth::user()->prodi_id)->where('akses','tendik')->get();
        return view('operator_unit/formulir_skp.index',[
            'tendiks'    =>  $tendiks,
            'datas'     =>  $datas,
        ]);
    }

    public function add(){
        if (empty(session('tendik'))) {
            $notification = array(
                'message' => 'Gagal, silahkan pilih tendik terlebih dahulu!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $tendik = User::findOrFail(session('tendik'));
        return view('operator_unit/formulir_skp.add',[
            'tendik' => $tendik,
        ]);
    }

    public function post(Request $request){
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

        FormulirSkpTendik::create([
            'tendik_id'              =>$request->tendik_id,
            'jenis_kegiatan'        =>$request->jenis_kegiatan,
            'bukti_penugasan'       =>$request->bukti_penugasan,
            'sks_beban_kerja'       =>$request->sks_beban_kerja,
            'masa_tugas'            =>$request->masa_tugas,
            'bukti_dokumen'         =>$request->bukti_dokumen,
            'persentase_capaian'    =>$request->persentase_capaian,
            'sks_kinerja'           =>$request->sks_kinerja,
        ]);

        $notification = array(
            'message' => 'Berhasil, data bkd tridharma'.$request->nama_tendik. 'berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.formulir_skp')->with($notification);
    }

    public function edit($id){
        if (empty(session('tendik'))) {
            $notification = array(
                'message' => 'Gagal, silahkan pilih tendik terlebih dahulu!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $tendik = User::findOrFail(session('tendik'));
        $data = FormulirSkpTendik::where('id',$id)->first();
        return view('operator_unit/formulir_skp.edit',[
            'tendik' => $tendik,
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

        FormulirSkpTendik::where('id',$id)->update([
            'jenis_kegiatan'        =>$request->jenis_kegiatan,
            'bukti_penugasan'       =>$request->bukti_penugasan,
            'sks_beban_kerja'       =>$request->sks_beban_kerja,
            'masa_tugas'            =>$request->masa_tugas,
            'bukti_dokumen'         =>$request->bukti_dokumen,
            'persentase_capaian'    =>$request->persentase_capaian,
            'sks_kinerja'           =>$request->sks_kinerja,
        ]);

        $notification = array(
            'message' => 'Berhasil, data bkd tridharma'.$request->nama_tendik. 'berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.formulir_skp')->with($notification);
    }
    public function delete($id){
        FormulirSkpTendik::where('id',$id)->delete();
        $notification = array(
            'message' => ' data bkd tridharma tendik berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator_unit.formulir_skp')->with($notification);
    }

    public function pilihTendik(Request $request){
        $attributes = [
            'tendik_id'          =>  'Nama Tendik',
        ];
        $this->validate($request, [
            'tendik_id'      =>'required',
        ],$attributes);

        $tendik = session('tendik');
        $user = User::where('id',$request->tendik_id)->first();
        $tendik = [
            'tendik_id'     => $user->id,
        ];
        session(['tendik' =>  $tendik['tendik_id']]);
        return redirect()->route('operator_unit.formulir_skp');
    }
}
