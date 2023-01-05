<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\BabIndikatorBanPtDosen;
use App\Models\Dosen;
use App\Models\HasilReviewBanPtDosen;
use App\Models\HasilReviewBanPtDosenDetail;
use App\Models\HasilReviewBanPtTendik;
use App\Models\HasilReviewBanPtTendikDetail;
use App\Models\HasilReviewManajerialTendik;
use App\Models\HasilReviewManajerialTendikDetail;
use App\Models\HasilReviewTeknisTendik;
use App\Models\HasilReviewTeknisTendikDetail;
use App\Models\IndikatorBanPtDosen;
use App\Models\IndikatorTendikBanPt;
use App\Models\IndikatorTendikBpmAspekManajerial;
use App\Models\IndikatorTendikBpmAspekTeknis;
use App\Models\KriteriaTendikBpmAspekManajerial;
use App\Models\KriteriaTendikBpmAspekTeknis;
use App\Models\Tendik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewerDashboardController extends Controller
{
    public function dashboard(){
        return view('reviewer.dashboard');
    }

    public function banPtDosen(){
        $babs = BabIndikatorBanPtDosen::all();
        return view('reviewer.review.ban_pt_dosen',[
            'babs'   =>  $babs
        ]);
    }

    public function banPtDosenPost(Request $request){
        $data = IndikatorBanPtDosen::all();
        $detail = array();
        $hasil = array();
        foreach ($data as $data) {
            $detail [] =  array(
                'indikator_id'	    =>  $data->id,
                'nilai'              =>  $_POST['nilai'.$data->id],
                'created_at'        =>  Carbon::now(),
                'updated_at'        =>  Carbon::now(),
            );
        }

        $total = array_sum(array_column($detail, 'nilai'));
        $hasil =  array(
            'reviewer_id'   =>  Auth::user()->id,
            'total'         =>  $total,
            'rata_rata'     =>  $total/$data->count(),
        );

        $post = HasilReviewBanPtDosen::create($hasil);
        for ($i=0; $i <count($detail) ; $i++) { 
            HasilReviewBanPtDosenDetail::create([
                'hasil_review_ban_pt_dosen_id'  =>  $post->id,
                'indikator_id'	    =>  $detail[$i]['indikator_id'],
                'nilai'              =>  $detail[$i]['nilai'],
                'created_at'        =>  $detail[$i]['created_at'],
                'updated_at'        =>  $detail[$i]['updated_at'],
            ]);
        }
        $notification = array(
            'message' => ' hasil reviewer berhasil disimpan!',
            'alert-type' => 'success'
        );
        return redirect()->route('reviewer.penilaian_banpt_dosen')->with($notification);
    }

    public function teknisTendik(){
        $babs = KriteriaTendikBpmAspekTeknis::all();
        $pegawais = Tendik::select('id','nama_tendik as nama_pegawai')->get()->toArray();
        return view('reviewer.review.teknis_tendik',[
            'babs'   =>  $babs,
            'pegawais'   =>  $pegawais,
        ]);
    }

    public function teknisTendikPost(Request $request){
        $data = IndikatorTendikBpmAspekTeknis::all();
        $detail = array();
        $hasil = array();
        foreach ($data as $data) {
            $detail [] =  array(
                'indikator_id'	    =>  $data->id,
                'nilai'              =>  $_POST['nilai'.$data->id],
                'created_at'        =>  Carbon::now(),
                'updated_at'        =>  Carbon::now(),
            );
        }

        $total = array_sum(array_column($detail, 'nilai'));
        $hasil =  array(
            'pegawai_id'    =>  $request->pegawai_id,
            'reviewer_id'   =>  Auth::user()->id,
            'total'         =>  $total,
            'rata_rata'     =>  $total/$data->count(),
        );

        $post = HasilReviewTeknisTendik::create($hasil);
        for ($i=0; $i <count($detail) ; $i++) { 
            HasilReviewTeknisTendikDetail::create([
                'hasil_review_teknis_tendik_id'  =>  $post->id,
                'indikator_id'	    =>  $detail[$i]['indikator_id'],
                'nilai'              =>  $detail[$i]['nilai'],
                'created_at'        =>  $detail[$i]['created_at'],
                'updated_at'        =>  $detail[$i]['updated_at'],
            ]);
        }
        $notification = array(
            'message' => ' hasil reviewer berhasil disimpan!',
            'alert-type' => 'success'
        );
        return redirect()->route('reviewer.penilaian_teknis')->with($notification);
    }

    public function manajerialTendik(){
        $babs = KriteriaTendikBpmAspekManajerial::all();
        $pegawais = Tendik::select('id','nama_tendik as nama_pegawai')->get()->toArray();
        return view('reviewer.review.manajerial_tendik',[
            'babs'   =>  $babs,
            'pegawais'   =>  $pegawais,
        ]);
    }

    public function manajerialTendikPost(Request $request){
        $data = IndikatorTendikBpmAspekManajerial::all();
        $detail = array();
        $hasil = array();
        foreach ($data as $data) {
            $detail [] =  array(
                'indikator_id'	    =>  $data->id,
                'nilai'              =>  $_POST['nilai'.$data->id],
                'created_at'        =>  Carbon::now(),
                'updated_at'        =>  Carbon::now(),
            );
        }

        $total = array_sum(array_column($detail, 'nilai'));
        $hasil =  array(
            'pegawai_id'    =>  $request->pegawai_id,
            'reviewer_id'   =>  Auth::user()->id,
            'total'         =>  $total,
            'rata_rata'     =>  $total/$data->count(),
        );

        $post = HasilReviewManajerialTendik::create($hasil);
        for ($i=0; $i <count($detail) ; $i++) { 
            HasilReviewManajerialTendikDetail::create([
                'hasil_review_manajerial_tendik_id'  =>  $post->id,
                'indikator_id'	    =>  $detail[$i]['indikator_id'],
                'nilai'              =>  $detail[$i]['nilai'],
                'created_at'        =>  $detail[$i]['created_at'],
                'updated_at'        =>  $detail[$i]['updated_at'],
            ]);
        }
        $notification = array(
            'message' => ' hasil reviewer berhasil disimpan!',
            'alert-type' => 'success'
        );
        return redirect()->route('reviewer.penilaian_manajerial')->with($notification);
    }

    public function banPtTendik(){
        $indikators = IndikatorTendikBanPt::all();
        $pegawais = Tendik::select('id','nama_tendik as nama_pegawai')->get()->toArray();
        return view('reviewer.review.ban_pt_tendik',[
            'indikators'   =>  $indikators,
            'pegawais'   =>  $pegawais,
        ]);
    }

    public function banPtTendikPost(Request $request){
        $data = IndikatorTendikBanPt::all();
        $detail = array();
        $hasil = array();
        foreach ($data as $data) {
            $detail [] =  array(
                'indikator_id'	    =>  $data->id,
                'nilai'              =>  $_POST['nilai'.$data->id],
                'created_at'        =>  Carbon::now(),
                'updated_at'        =>  Carbon::now(),
            );
        }

        $total = array_sum(array_column($detail, 'nilai'));
        $hasil =  array(
            'pegawai_id'    =>  $request->pegawai_id,
            'reviewer_id'   =>  Auth::user()->id,
            'total'         =>  $total,
            'rata_rata'     =>  $total/$data->count(),
        );

        $post = HasilReviewBanPtTendik::create($hasil);
        for ($i=0; $i <count($detail) ; $i++) { 
            HasilReviewBanPtTendikDetail::create([
                'hasil_review_ban_pt_tendik_id'  =>  $post->id,
                'indikator_id'	    =>  $detail[$i]['indikator_id'],
                'nilai'              =>  $detail[$i]['nilai'],
                'created_at'        =>  $detail[$i]['created_at'],
                'updated_at'        =>  $detail[$i]['updated_at'],
            ]);
        }
        $notification = array(
            'message' => ' hasil reviewer berhasil disimpan!',
            'alert-type' => 'success'
        );
        return redirect()->route('reviewer.penilaian_banpt_tendik')->with($notification);
    }
}
