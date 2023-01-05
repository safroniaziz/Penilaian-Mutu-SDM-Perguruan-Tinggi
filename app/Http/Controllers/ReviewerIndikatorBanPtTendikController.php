<?php

namespace App\Http\Controllers;

use App\Models\ReviewerIndikatorBanPtTendik;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewerIndikatorBanPtTendikController extends Controller
{
    public function index(){
        $reviewers = ReviewerIndikatorBanPtTendik::all();
        return view('lpmpp/reviewer_ban_pt_tendik.index', compact('reviewers'));
    }

    public function add(){
        $reviewers = User::where('akses','reviewer')->get();
        return view('lpmpp/reviewer_ban_pt_tendik.add',[
            'reviewers' =>  $reviewers
        ]);
    }

    public function post(Request $request){
        $attributes = [
            'reviewer_id'         =>  'Nama Reviewer',
        ];
        $this->validate($request, [
            'reviewer_id'         =>'required',
        ],$attributes);

        ReviewerIndikatorBanPtTendik::create([
            'reviewer_id'         =>  $request->reviewer_id,
        ]);

        $notification = array(
            'message' => 'Berhasil, data reviewer ban pt berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.reviewer_ban_pt_tendik')->with($notification);
    }
    
    public function delete($id){
        ReviewerIndikatorBanPtTendik::where('id',$id)->delete();
        $notification = array(
            'message' => ' data reviewer btn pt berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.reviewer_ban_pt_tendik')->with($notification);
    }
}
