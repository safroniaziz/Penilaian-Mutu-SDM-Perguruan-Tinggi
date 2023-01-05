<?php

namespace App\Http\Controllers\Tendik;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\IkkPimpinan;
use App\Models\SkpTendik;
use App\Models\SkpTendikDetail;
use App\Models\Tendik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \PDF;

class TendikSkpController extends Controller
{
    public function index(){
        $dosens = Dosen::select('id','nama_dosen as nama_pejabat')->get()->toArray();
        $tendiks = Tendik::select('id','nama_tendik as nama_pejabat')->get()->toArray();
        $pejabats = array_merge($dosens,$tendiks);
        $tendik = Auth::guard('tendik')->user();
        return view('tendik/skp_pegawai.index',[
            'pejabats' =>  $pejabats,
            'tendik'    =>  $tendik
        ]);
    }

    public function post(Request $request){
        $rules = [
            'pejabat_penilai_id'          =>  'required',
            'atasan_pejabat_penilai_id'      =>  'required',
            'triwulan'               =>  'required',
            'periode_awal'            =>  'required',
            'periode_akhir'             =>  'required',
            'capaian_kinerja_organisasi'              =>  'required',
            'ttd_pejabat'     =>  'required',
            'ttd_pejabat_penilai'     =>  'required',
            'ttd_atasan_pejabat_penilai'     =>  'required',
            'rating_hasil_kerja'     =>  'required',
            'rating_perilaku_kerja'     =>  'required',
        ];
        $text = [
            'pejabat_penilai_id.required'          =>  'Pejabat Penilai Harus Dipilih',
            'atasan_pejabat_penilai_id.required'      =>  'Atasan Pejabat Penilai Harus Dipilih',
            'triwulan.required'                =>  'Periode Triwulan Harus Dipilih',
            'periode_awal.required'               =>  'Periode Penilaian Sampai Tidak Boleh Kosong',
            'periode_akhir.required'               =>  'Periode Penilaian Sampai Tidak Boleh Kosong',
            'capaian_kinerja_organisasi.required'               =>  'Capaian Kinerja Organisasi Harus Dipilij',
            'ttd_pejabat.required'               =>  'TTD Pejabat Tidak Boleh Kosong',
            'ttd_pejabat_penilai.required'               =>  'TTD Pejabat Penilai Tidak Boleh Kosong',
            'ttd_atasan_pejabat_penilai.required'               =>  'TTD Atasan Pejabat Penilai Tidak Boleh Kosong',
            'rating_hasil_kerja.required'               =>  'Rating Hasil Kerja Tidak Boleh Kosong',
            'rating_perilaku_kerja.required'               =>  'Rating Perilaku Kerja Tidak Boleh Kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['error'  =>  0, 'text'   =>  $validasi->errors()->first()],422);
        }

        $simpan = SkpTendik::create([
            'tendik_id'                     =>  Auth::guard('tendik')->user()->id,
            'pejabat_penilai_id'            =>  $request->pejabat_penilai_id,
            'atasan_pejabat_penilai_id'     =>  $request->atasan_pejabat_penilai_id,
            'triwulan'                      =>  $request->triwulan,
            'periode_awal'                  =>  $request->periode_awal,
            'periode_akhir'                 =>  $request->periode_akhir,
            'capaian_kinerja_organisasi'    =>  $request->capaian_kinerja_organisasi,
            'ttd_pejabat'                   =>  $request->ttd_pejabat,
            'ttd_pejabat_penilai'           =>  $request->ttd_pejabat_penilai,
            'ttd_atasan_pejabat_penilai'    =>  $request->ttd_atasan_pejabat_penilai,
            'rating_hasil_kerja'            =>  $request->rating_hasil_kerja,
            'rating_perilaku_kerja'         =>  $request->rating_perilaku_kerja,
        ]);
        if ($simpan) {
            return response()->json([
                'text'  =>  'Selamat, Skp Anda Berhasil Ditambahkan',
                'url'   =>  url('/tendik/manajemen_data_skp'),
            ]);
        }else {
            return response()->json(['text' =>  'Oopps, Skp Anda Gagal Ditambahkan']);
        }
    }

    public function detail(SkpTendik $skp){
        $tendik = Auth::guard('tendik')->user();
        $ikus = IkkPimpinan::where('unit_id',$tendik->unit_id)->get();
        return view('tendik/skp_pegawai.add_detail',[
            'ikus'  =>  $ikus,
            'tendik' =>  $tendik,
            'skp'   =>  $skp,
        ]);
    }

    public function cariIkk(Request $request){
        return $ikk = IkkPimpinan::where('id',$request->ikk_pimpinan_id)->first();
    }

    public function detailPost(Request $request, SkpTendik $skp){
        $rules = [
            'ikk_pimpinan_id'      =>  'required',
            'isi_ikk'               =>  'required',
            'target_ikk'            =>  'required',
            'realisasi_bukti_dukung'             =>  'required',
            'umpan_balik_berkelanjutan'              =>  'required',
            'angka'     =>  'required',
        ];
        $text = [
            'ikk_pimpinan_id.required'          =>  'Ikk Pimpinan Harus Dipilih',
            'isi_ikk.required'                =>  'Isi Ikk Tidak Boleh Kosong',
            'target_ikk.required'               =>  'Target Ikk Tidak Boleh Kosong',
            'realisasi_bukti_dukung.required'               =>  'Realisasi Bukti Dukung Tidak Boleh Kosong',
            'umpan_balik_berkelanjutan.required'               =>  'Umpan Balik Berkelanjutan Tidak Boleh Kosong',
            'angka.required'               =>  'Hasil Kerja Tidak Boleh Kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['error'  =>  0, 'text'   =>  $validasi->errors()->first()],422);
        }

        $simpan = SkpTendikDetail::create([
            'skp_tendik_id'                  =>  $skp->id,
            'ikk_pimpinan_id'               =>  $request->ikk_pimpinan_id,
            'isi_ikk'                       =>  $request->isi_ikk,
            'target_ikk'                    =>  $request->target_ikk,
            'realisasi_bukti_dukung'        =>  $request->realisasi_bukti_dukung,
            'umpan_balik_berkelanjutan'     =>  $request->umpan_balik_berkelanjutan,
            'angka'                         =>  $request->angka,
        ]);
        if ($simpan) {
            return response()->json([
                'text'  =>  'Selamat, Detail SKP Berhasil Ditambahkan',
                'url'   =>  url('/tendik/manajemen_data_skp'),
            ]);
        }else {
            return response()->json(['text' =>  'Oopps, Detail Skp Anda Gagal Ditambahkan']);
        }
    }

    public function skpDetailEdit(SkpTendikDetail $skpDetail){
        $tendik = Auth::guard('tendik')->user();
        $ikus = IkkPimpinan::where('unit_id',$tendik->unit_id)->get();
        return view('tendik/skp_pegawai.edit_detail',[
            'ikus'  =>  $ikus,
            'tendik' =>  $tendik,
            'skpDetail'   =>  $skpDetail,
        ]);
    }

    public function skpDetailUpdate(Request $request, SkpTendikDetail $skpDetail){
        $rules = [
            'ikk_pimpinan_id'      =>  'required',
            'isi_ikk'               =>  'required',
            'target_ikk'            =>  'required',
            'realisasi_bukti_dukung'             =>  'required',
            'umpan_balik_berkelanjutan'              =>  'required',
            'angka'     =>  'required',
        ];
        $text = [
            'ikk_pimpinan_id.required'          =>  'Ikk Pimpinan Harus Dipilih',
            'isi_ikk.required'                =>  'Isi Ikk Tidak Boleh Kosong',
            'target_ikk.required'               =>  'Target Ikk Tidak Boleh Kosong',
            'realisasi_bukti_dukung.required'               =>  'Realisasi Bukti Dukung Tidak Boleh Kosong',
            'umpan_balik_berkelanjutan.required'               =>  'Umpan Balik Berkelanjutan Tidak Boleh Kosong',
            'angka.required'               =>  'Hasil Kerja Tidak Boleh Kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['error'  =>  0, 'text'   =>  $validasi->errors()->first()],422);
        }

        $update = $skpDetail->update([
            'ikk_pimpinan_id'               =>  $request->ikk_pimpinan_id,
            'isi_ikk'                       =>  $request->isi_ikk,
            'target_ikk'                    =>  $request->target_ikk,
            'realisasi_bukti_dukung'        =>  $request->realisasi_bukti_dukung,
            'umpan_balik_berkelanjutan'     =>  $request->umpan_balik_berkelanjutan,
            'angka'                         =>  $request->angka,
        ]);
        if ($update) {
            return response()->json([
                'text'  =>  'Selamat, Detail SKP Berhasil Diubah',
                'url'   =>  url('/tendik/manajemen_data_skp'),
            ]);
        }else {
            return response()->json(['text' =>  'Oopps, Detail Skp Anda Gagal Diubah']);
        }
    }

    public function detailDelete(Request $request){
        $detail = SkpTendikDetail::where('id',$request->skp_detail_id)->first();
        $delete = $detail->delete();
        
        if ($delete) {
            return response()->json([
                'text'  =>  'Selamat, Detail SKP Berhasil Dihapus',
                'url'   =>  url('/tendik/manajemen_data_skp'),
            ]);
        }else {
            return response()->json(['text' =>  'Oopps, Detail Skp Anda Gagal Dihapus']);
        }
    }

    public function cetakSkpPegawai(){
        $id =  Auth::guard('tendik')->user()->id;
        $tendik = Tendik::with(['skp.skpDetails'])->where('id',$id)->first();
        $pdf = PDF::loadView('tendik/skp_pegawai.cetak_skp_pegawai',[
            'tendik' =>  $tendik,
        ]);
        $pdf->setPaper('a4','landscape');
        return $pdf->stream('skp_pegawai' . Carbon::now() . '.pdf');
    }

    public function cetakSasaranKinerjaPegawai(){
        $id =  Auth::guard('tendik')->user()->id;
        $tendik = Tendik::with(['skp.skpDetails'])->where('id',$id)->first();
        $pdf = PDF::loadView('tendik/skp_pegawai._cetak_sasaran_kinerja_pegawai',[
            'tendik' =>  $tendik,
        ]);
        $pdf->setPaper('a4','landscape');
        return $pdf->stream('sasaran_kinerja_pegawai' . Carbon::now() . '.pdf');
    }

    public function cetakEvaluasiPegawai(){
        $id =  Auth::guard('tendik')->user()->id;
        $tendik = Tendik::with(['skp.skpDetails'])->where('id',$id)->first();
        $pdf = PDF::loadView('tendik/skp_pegawai._cetak_evaluasi_pegawai',[
            'tendik' =>  $tendik,
        ]);
        $pdf->setPaper('a4','landscape');
        return $pdf->setOptions([
            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true
        ])->stream('evaluasi_pegawai' . Carbon::now() . '.pdf');
    }

    public function cetakNilaiKinerja(){
        $id =  Auth::guard('tendik')->user()->id;
        $tendik = Tendik::with(['skp.skpDetails'])->where('id',$id)->first();
        $pdf = PDF::loadView('tendik/skp_pegawai._cetak_nilai_kinerja',[
            'tendik' =>  $tendik,
        ]);
        $pdf->setPaper('a4','portrait');
        return $pdf->setOptions([
            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true
        ])->stream('evaluasi_pegawai' . Carbon::now() . '.pdf');
    }
}
