<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\HasilReviewBanPtDosen;
use App\Models\HasilReviewBanPtDosenDetail;
use App\Models\HasilReviewBanPtTendik;
use App\Models\HasilReviewManajerialTendik;
use App\Models\HasilReviewTeknisTendik;
use Illuminate\Http\Request;

class LaporanReview extends Controller
{
    public function banPtDosen(){
        $hasils = HasilReviewBanPtDosen::all();
        return view('lpmpp/laporan_review.ban_pt_dosen', compact('hasils'));
    }

    public function laporanTeknis(){
        $hasils = HasilReviewTeknisTendik::all();
        return view('lpmpp/laporan_review.laporan_teknis', compact('hasils'));
    }

    public function laporanManajerial(){
        $hasils = HasilReviewManajerialTendik::all();
        return view('lpmpp/laporan_review.laporan_manajerial', compact('hasils'));
    }

    public function laporanBanPtTendik(){
        $hasils = HasilReviewBanPtTendik::all();
        return view('lpmpp/laporan_review.laporan_banpt_tendik', compact('hasils'));
    }
}
