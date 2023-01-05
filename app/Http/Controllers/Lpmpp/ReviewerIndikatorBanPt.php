<?php

namespace App\Http\Controllers\Lpmpp;

use App\Http\Controllers\Controller;
use App\Models\BabIndikatorBanPtDosen;
use App\Models\ReviewerBanPt;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewerIndikatorBanPt extends Controller
{
    public function index(){
        $reviewers = ReviewerBanPt::all();
        return view('lpmpp/reviewer_ban_pt.index', compact('reviewers'));
    }

    public function add(){
        $reviewers = User::where('akses','reviewer')->get();
        return view('lpmpp/reviewer_ban_pt.add',[
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

        ReviewerBanPt::create([
            'reviewer_id'         =>  $request->reviewer_id,
        ]);

        $notification = array(
            'message' => 'Berhasil, data reviewer ban pt berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.tendik_ban_pt')->with($notification);
    }
    
    public function delete($id){
        ReviewerBanPt::where('id',$id)->delete();
        $notification = array(
            'message' => ' data reviewer btn pt berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.tendik_ban_pt')->with($notification);
    }
}
