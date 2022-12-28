<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PandaController;
use App\Models\Dosen;
use App\Models\DosenPa;
use App\Models\DosenRiwayatGolongan;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Break_;

class LppmProdiController extends Controller
{
    public function index(){
        $grafikMahasiswa = Unit::where('jenis_unit','fakultas')->get();
        $grafikDosen = Unit::where('jenis_unit','fakultas')->get();
        $prodis = Prodi::with('mahasiswas')->orderBy('unit_id')->get();
        return view('lpmpp/prodi.index',compact('prodis','grafikMahasiswa','grafikDosen'));
    }

    public function add(){
        $fakultas = Unit::where('jenis_unit','fakultas')->get();
        return view('lpmpp/prodi.add',[
            'fakultas' => $fakultas,
        ]);
    }

    public function post(Request $request){
        $attributes = [
            'unit_id'           =>  'Nama Fakultas',
            'nama_prodi'            =>  'Nama Program Studi',
            'jumlah_mahasiswa'      =>  'Jumlah Mahasiswa',
            'jumlah_prodi'          =>  'Jumlah Dosen',
        ];
        $this->validate($request, [
            'unit_id'           =>'required',
            'nama_prodi'              =>'required',
            'jumlah_prodi'          =>'numeric',
        ],$attributes);

        Prodi::create([
            'unit_id'           =>  $request->unit_id,
            'nama_prodi'              =>  $request->nama_prodi,
            'jumlah_mahasiswa'      =>  $request->jumlah_mahasiswa,
            'jumlah_prodi'          =>  $request->jumlah_dosen
        ]);

        $notification = array(
            'message' => 'Berhasil, data prodi berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.prodi')->with($notification);
    }
    public function edit($id){
        $fakultas = Unit::where('jenis_unit','fakultas')->get();
        $data = Prodi::where('id',$id)->first();
        return view('lpmpp/prodi.edit',[
            'fakultas' => $fakultas,
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id){
        $attributes = [
            'unit_id'           =>  'Nama Fakultas',
            'nama_prodi'            =>  'Nama Program Studi',
            'jumlah_mahasiswa'      =>  'Jumlah Mahasiswa',
            'jumlah_dosen'          =>  'Jumlah Dosen',
        ];
        $this->validate($request, [
            'unit_id'           =>'required',
            'nama_prodi'              =>'required',
        ],$attributes);

        Prodi::where('id',$id)->update([
            'unit_id'           =>  $request->unit_id,
            'nama_prodi'              =>  $request->nama_prodi,
            'jumlah_mahasiswa'      =>  $request->jumlah_mahasiswa,
            'jumlah_dosen'          =>  $request->jumlah_dosen
        ]);

        $notification = array(
            'message' => 'Berhasil, data prodi berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.prodi')->with($notification);
    }
    public function delete($id){
        Prodi::where('id',$id)->delete();
        $notification = array(
            'message' => ' data prodi berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.fakultas')->with($notification);
    }

    public function sync(){
        DB::beginTransaction();
        try {
            $panda = new PandaController();
            $fakultas = Unit::where('jenis_unit','fakultas')->select('id')->get();
            $datas = array();
            $datas2 = array();
            for ($i=0; $i <count($fakultas) ; $i++) { 
                $prodi = '
                    {fakultas(fakKode:'.$fakultas[$i]->id.') {
                        fakKode
                        prodi {
                            prodiKode
                            prodiNamaResmi
                            count_mahasiswa
                            dosen {
                                dsnPegNip
                            }
                        }
                    }}
                ';
                $prodis = $panda->panda($prodi);
                $datas [] = array(
                    'prodi'         =>  $prodis,
                );
            }


            // return $datas;
            for ($j=0; $j < count($datas); $j++) { 
                for ($k=0; $k <count($datas[$j]['prodi']['fakultas'][0]['prodi']) ; $k++) { 
                    $datas2 [] = array(
                        'id'                =>  $datas[$j]['prodi']['fakultas'][0]['prodi'][$k]['prodiKode'],
                        'unit_id'       =>  $datas[$j]['prodi']['fakultas'][0]['fakKode'],
                        'nama_prodi'        =>  $datas[$j]['prodi']['fakultas'][0]['prodi'][$k]['prodiNamaResmi'],
                        'jumlah_mahasiswa'  =>  $datas[$j]['prodi']['fakultas'][0]['prodi'][$k]['count_mahasiswa'],
                        'jumlah_dosen'      =>  count($datas[$j]['prodi']['fakultas'][0]['prodi'][$k]['dosen']),
                        'created_at'    =>  Carbon::now()->format("Y-m-d H:i:s"),
                        'updated_at'    =>  Carbon::now()->format("Y-m-d H:i:s"),
                    );
                }
            }
            DB::table('prodis')->delete();
            Prodi::insert($datas2);

            DB::commit();
            $notification = array(
                'message' => 'sinkronisasi data program studi dengan portal akademik berhasil !',
                'alert-type' => 'success'
            );
            return redirect()->route('lpmpp.prodi')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'sinkronisasi data program studi dengan portal akademik gagal !',
                'alert-type' => 'error'
            );
            return redirect()->route('lpmpp.prodi')->with($notification);
        }
    }

    public function syncMahasiswa(Prodi $prodi){
        DB::beginTransaction();
        try {
            Mahasiswa::where('prodi_id',$prodi->id)->delete();
            $panda = new PandaController();
            $datas2 = array();
            $mahasiswa = '
                {prodi(prodiKode:'.$prodi->id.') {
                    prodiKode
                    mahasiswa {
                        mhsNiu
                        mhsNama
                        mhsProdiKode
                        mhsAngkatan
                        mhsJenisKelamin
                        mhsTanggalLulus
                    }}
                }
            ';
            $mahasiswas = $panda->panda($mahasiswa);
            $datas = $mahasiswas['prodi'][0]['mahasiswa'];
            for ($i=0; $i <count($datas); $i++) { 
                if ($datas[$i]['mhsTanggalLulus'] == null && $datas[$i]['mhsTanggalLulus'] == "") {
                    Mahasiswa::create([
                        'prodi_id'          =>  $prodi->id,
                        'npm'               =>  $datas[$i]['mhsNiu'],
                        'nama_mahasiswa'    =>  $datas[$i]['mhsNama'],
                        'angkatan'          =>  $datas[$i]['mhsAngkatan'],
                        'jenis_kelamin'     =>  $datas[$i]['mhsJenisKelamin'],
                    ]);
                }
            }

            DB::commit();
            $notification = array(
                'message' => 'sinkronisasi data mahasiswa dengan portal akademik berhasil !',
                'alert-type' => 'success'
            );
            return redirect()->route('lpmpp.prodi')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'sinkronisasi data mahasiswa dengan portal akademik gagal !',
                'alert-type' => 'error'
            );
            return redirect()->route('lpmpp.prodi')->with($notification);
        }
    }

    public function detailMahasiswa(Prodi $prodi){
        $grafikAngkatan = Mahasiswa::select(DB::raw('count(id) as jumlah_mahasiswa'),'angkatan')->where('prodi_id',$prodi->id)->groupBy('angkatan')->get();
        $grafikJk = Mahasiswa::select(DB::raw('count(id) as jumlah_mahasiswa'),'jenis_kelamin')->where('prodi_id',$prodi->id)->groupBy('jenis_kelamin')->get();
        $mahasiswas = Mahasiswa::where('prodi_id',$prodi->id)->orderBy('angkatan','desc')->get();
        return view('lpmpp.prodi.detail_mahasiswa',[
            'mahasiswas'        =>  $mahasiswas,
            'prodi'             =>  $prodi,
            'grafikAngkatan'    =>  $grafikAngkatan,
            'grafikJk'    =>  $grafikJk,
        ]);
    }

    public function syncMahasiswaDetail(Prodi $prodi){
        DB::beginTransaction();
        try {
            Mahasiswa::where('prodi_id',$prodi->id)->delete();
            $panda = new PandaController();
            $datas2 = array();
            $mahasiswa = '
                {prodi(prodiKode:'.$prodi->id.') {
                    prodiKode
                    mahasiswa {
                        mhsNiu
                        mhsNama
                        mhsProdiKode
                        mhsAngkatan
                        mhsJenisKelamin
                        mhsTanggalLulus
                    }}
                }
            ';
            $mahasiswas = $panda->panda($mahasiswa);
            $datas = $mahasiswas['prodi'][0]['mahasiswa'];
            for ($i=0; $i <count($datas); $i++) { 
                if ($datas[$i]['mhsTanggalLulus'] == null && $datas[$i]['mhsTanggalLulus'] == "") {
                    Mahasiswa::create([
                        'prodi_id'          =>  $prodi->id,
                        'npm'               =>  $datas[$i]['mhsNiu'],
                        'nama_mahasiswa'    =>  $datas[$i]['mhsNama'],
                        'angkatan'          =>  $datas[$i]['mhsAngkatan'],
                        'jenis_kelamin'     =>  $datas[$i]['mhsJenisKelamin'],
                    ]);
                }
            }
            
            DB::commit();
            $notification = array(
                'message' => 'sinkronisasi data mahasiswa dengan portal akademik berhasil !',
                'alert-type' => 'success'
            );
            return redirect()->route('lpmpp.prodi.detail_mahasiswa',[$prodi->id])->with($notification);

        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'sinkronisasi data mahasiswa dengan portal akademik gagal !',
                'alert-type' => 'error'
            );
            return redirect()->route('lpmpp.prodi.detail_mahasiswa',[$prodi->id])->with($notification);
        }
    }

    public function syncDosen(Prodi $prodi){
        DB::beginTransaction();
        try {
            Dosen::where('prodi_id',$prodi->id)->delete();
            $panda = new PandaController();
            $dosen = '
                {prodi(prodiKode:'.$prodi->id.') {
                    prodiKode
                    dosen {
                        dsnPegNip
                        dsnNidn
                        jabatanAkademik
                        pegawai {
                                pegNama
                                pegGelarDepan
                                pegGelarBelakang
                                pegIsAktif
                                pegGolrKodePns
                                pegawai_simpeg {
                                pegJenkel
                                pegKedHukum
                                pegIdTugas
                                pegTgstambahan
                                pegPendAkhir
                            }
                            riwayat_golongan {
                                goGol
                                goNoSk
                                goTglSk
                                goTmtGol
                            }
                        }
                        mahasiswa_pa {
                                mhsNiu
                                mhsNama
                                mhsAngkatan
                                mhsJenisKelamin
                                prodi {
                                prodiNamaResmi
                            }
                        }
                    }
                }}
            ';
            $dosens = $panda->panda($dosen);
            if (count($dosens['prodi'])> 0) {
                $datas = $dosens['prodi'][0]['dosen'];
            }else {
                $notification = array(
                    'message' => 'sinkronisasi gagal, data dosen tidak ditemukan!',
                    'alert-type' => 'error'
                );
                return redirect()->route('lpmpp.prodi')->with($notification);
            }
            if (count($dosens['prodi'][0]['dosen'])> 0) {
                for ($i=0; $i <count($datas); $i++) { 
                    $mahasiswa_pa       = $datas[$i]['mahasiswa_pa'];
                    $riwayat_golongan   =  $datas[$i]['pegawai']['riwayat_golongan'];
                    if ($datas[$i]['pegawai']['pegIsAktif'] == 1) {
                        if ($datas[$i]['pegawai']['pegawai_simpeg'] == null || $datas[$i]['pegawai']['pegawai_simpeg'] == "") {
                            $jenis_kelamin      = '-';
                            $kedudukan_hukum    = '-';
                            $tugas_tambahan     = '-';
                            $pendidikan_akhir   = '-';
                        }else {
                            $jenis_kelamin     =  $datas[$i]['pegawai']['pegawai_simpeg']['pegJenkel'];
                            $kedudukan_hukum   =  $datas[$i]['pegawai']['pegawai_simpeg']['pegKedHukum'];
                            $tugas_tambahan    =  $datas[$i]['pegawai']['pegawai_simpeg']['pegTgstambahan'];
                            $pendidikan_akhir  =  $datas[$i]['pegawai']['pegawai_simpeg']['pegPendAkhir'];
                        }
                        Dosen::create([
                            'id'                =>  $datas[$i]['dsnPegNip'],
                            'prodi_id'          =>  $prodi->id,
                            'nama_dosen'        =>  $datas[$i]['pegawai']['pegNama'],
                            'nidn'              =>  $datas[$i]['dsnNidn'],
                            'jabatan_akademik'  =>  $datas[$i]['jabatanAkademik'],
                            'gelar_depan'       =>  $datas[$i]['pegawai']['pegGelarDepan'],
                            'gelar_belakang'    =>  $datas[$i]['pegawai']['pegGelarBelakang'],
                            'golongan'          =>  $datas[$i]['pegawai']['pegGolrKodePns'],
                            'jenis_kelamin'     =>  $jenis_kelamin,
                            'kedudukan_hukum'   =>  $kedudukan_hukum,
                            'tugas_tambahan'    =>  $tugas_tambahan,
                            'pendidikan_akhir'  =>  $pendidikan_akhir,
                        ]);

                        if (count($mahasiswa_pa)>0) {
                            for ($j=0; $j <count($mahasiswa_pa)  ; $j++) { 
                                DosenPa::create([
                                    'dosen_id'          =>  $datas[$i]['dsnPegNip'],
                                    'npm_mahasiswa'     =>  $mahasiswa_pa[$j]['mhsNiu'],
                                    'nama_mahasiswa'    =>  $mahasiswa_pa[$j]['mhsNama'],
                                    'prodi'             =>  $mahasiswa_pa[$j]['prodi']['prodiNamaResmi'],
                                    'angkatan'          =>  $mahasiswa_pa[$j]['mhsAngkatan'],
                                    'jenis_kelamin'     =>  $mahasiswa_pa[$j]['mhsJenisKelamin'],
                                ]);
                            }
                        }
        
                        for ($k=0; $k <count($riwayat_golongan)  ; $k++) { 
                            DosenRiwayatGolongan::create([
                                'dosen_id'          =>  $datas[$i]['dsnPegNip'],
                                'golongan'          =>  $riwayat_golongan[$k]['goGol'],
                                'no_sk'             =>  $riwayat_golongan[$k]['goNoSk'],
                                'tanggal_sk'        =>  $riwayat_golongan[$k]['goTglSk'],
                                'golongan_tmt'      =>  $riwayat_golongan[$k]['goTmtGol'],
                                
                            ]);
                        }
                    }
                }
            }else {
                $notification = array(
                    'message' => 'sinkronisasi gagal, data dosen tidak ditemukan!',
                    'alert-type' => 'error'
                );
                return redirect()->route('lpmpp.prodi')->with($notification);
            }
            
            DB::commit();
            $notification = array(
                'message' => 'sinkronisasi data dosen dengan portal akademik berhasil !',
                'alert-type' => 'success'
            );
            return redirect()->route('lpmpp.prodi')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'sinkronisasi data dosen dengan portal akademik gagal !',
                'alert-type' => 'error'
            );
            return redirect()->route('lpmpp.prodi')->with($notification);
        }
    }

    public function detailDosen(Prodi $prodi){
        $grafikGolongan = Dosen::select(DB::raw('count(id) as jumlah_dosen'),'golongan')->where('prodi_id',$prodi->id)->groupBy('golongan')->get();
        $grafikJabatan = Dosen::select(DB::raw('count(id) as jumlah_dosen'),'jabatan_akademik')->where('prodi_id',$prodi->id)->groupBy('jabatan_akademik')->get();
        $dosens = Dosen::where('prodi_id',$prodi->id)->orderBy('golongan','desc')->get();
        return view('lpmpp.prodi.detail_dosen',[
            'dosens'            =>  $dosens,
            'prodi'             =>  $prodi,
            'grafikGolongan'    =>  $grafikGolongan,
            'grafikJabatan'     =>  $grafikJabatan,
        ]);
    }

    public function syncDosenDetail(Prodi $prodi){
        DB::beginTransaction();
        try {
            Dosen::where('prodi_id',$prodi->id)->delete();
            $panda = new PandaController();
            $dosen = '
                {prodi(prodiKode:'.$prodi->id.') {
                    prodiKode
                    dosen {
                        dsnPegNip
                        dsnNidn
                        jabatanAkademik
                        pegawai {
                                pegNama
                                pegGelarDepan
                                pegGelarBelakang
                                pegIsAktif
                                pegGolrKodePns
                                pegawai_simpeg {
                                pegJenkel
                                pegKedHukum
                                pegIdTugas
                                pegTgstambahan
                                pegPendAkhir
                            }
                            riwayat_golongan {
                                goGol
                                goNoSk
                                goTglSk
                                goTmtGol
                            }
                        }
                        mahasiswa_pa {
                                mhsNiu
                                mhsNama
                                mhsAngkatan
                                mhsJenisKelamin
                                prodi {
                                prodiNamaResmi
                            }
                        }
                    }
                }}
            ';
            $dosens = $panda->panda($dosen);
            $datas = $dosens['prodi'][0]['dosen'];
            for ($i=0; $i <count($datas); $i++) { 
                
                $mahasiswa_pa       = $datas[$i]['mahasiswa_pa'];
                $riwayat_golongan   =  $datas[$i]['pegawai']['riwayat_golongan'];
                if ($datas[$i]['pegawai']['pegIsAktif'] == 1) {
                    if ($datas[$i]['pegawai']['pegawai_simpeg'] == null) {
                        $jenis_kelamin      = '-';
                        $kedudukan_hukum    = '-';
                        $tugas_tambahan     = '-';
                        $pendidikan_akhir   = '-';
                    }else {
                        $jenis_kelamin     =  $datas[$i]['pegawai']['pegawai_simpeg']['pegJenkel'];
                        $kedudukan_hukum   =  $datas[$i]['pegawai']['pegawai_simpeg']['pegKedHukum'];
                        $tugas_tambahan    =  $datas[$i]['pegawai']['pegawai_simpeg']['pegTgstambahan'];
                        $pendidikan_akhir  =  $datas[$i]['pegawai']['pegawai_simpeg']['pegPendAkhir'];
                    }
                    Dosen::create([
                        'id'                =>  $datas[$i]['dsnPegNip'],
                        'prodi_id'          =>  $prodi->id,
                        'nama_dosen'        =>  $datas[$i]['pegawai']['pegNama'],
                        'nidn'              =>  $datas[$i]['dsnNidn'],
                        'jabatan_akademik'  =>  $datas[$i]['jabatanAkademik'],
                        'gelar_depan'       =>  $datas[$i]['pegawai']['pegGelarDepan'],
                        'gelar_belakang'    =>  $datas[$i]['pegawai']['pegGelarBelakang'],
                        'golongan'          =>  $datas[$i]['pegawai']['pegGolrKodePns'],
                        'jenis_kelamin'     =>  $jenis_kelamin,
                        'kedudukan_hukum'   =>  $kedudukan_hukum,
                        'tugas_tambahan'    =>  $tugas_tambahan,
                        'pendidikan_akhir'  =>  $pendidikan_akhir,
                    ]);
                }
                for ($j=0; $j <count($mahasiswa_pa)  ; $j++) { 
                    DosenPa::create([
                        'dosen_id'          =>  $datas[$i]['dsnPegNip'],
                        'npm_mahasiswa'     =>  $mahasiswa_pa[$j]['mhsNiu'],
                        'nama_mahasiswa'    =>  $mahasiswa_pa[$j]['mhsNama'],
                        'prodi'             =>  $mahasiswa_pa[$j]['prodi']['prodiNamaResmi'],
                        'angkatan'          =>  $mahasiswa_pa[$j]['mhsAngkatan'],
                        'jenis_kelamin'     =>  $mahasiswa_pa[$j]['mhsJenisKelamin'],
                    ]);
                }

                for ($k=0; $k <count($riwayat_golongan)  ; $k++) { 
                    DosenRiwayatGolongan::create([
                        'dosen_id'          =>  $datas[$i]['dsnPegNip'],
                        'golongan'          =>  $riwayat_golongan[$k]['goGol'],
                        'no_sk'             =>  $riwayat_golongan[$k]['goNoSk'],
                        'tanggal_sk'        =>  $riwayat_golongan[$k]['goTglSk'],
                        'golongan_tmt'      =>  $riwayat_golongan[$k]['goTmtGol'],
                        
                    ]);
                }
            }
            
            DB::commit();
            $notification = array(
                'message' => 'sinkronisasi data dosen dengan portal akademik berhasil !',
                'alert-type' => 'success'
            );
            return redirect()->route('lpmpp.prodi.detail_dosen',[$prodi->id])->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'sinkronisasi data dosen dengan portal akademik gagal !',
                'alert-type' => 'error'
            );
            return redirect()->route('lpmpp.prodi.detail_dosen',[$prodi->id])->with($notification);
        }
    }
}
