<?php

namespace App\Http\Controllers;

use App\Models\ReviewerIndikatorManajerial;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewerIndikatorManajerialController extends Controller
{
    public function index(){
        $reviewers = ReviewerIndikatorManajerial::all();
        return view('lpmpp/reviewer_manajerial.index', compact('reviewers'));
    }

    public function add(){
        $reviewers = User::where('akses','reviewer')->get();
        return view('lpmpp/reviewer_manajerial.add',[
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

        ReviewerIndikatorManajerial::create([
            'reviewer_id'         =>  $request->reviewer_id,
        ]);

        $notification = array(
            'message' => 'Berhasil, data reviewer ban pt berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.reviewer_manajerial')->with($notification);
    }
    
    public function delete($id){
        ReviewerIndikatorManajerial::where('id',$id)->delete();
        $notification = array(
            'message' => ' data reviewer btn pt berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.reviewer_manajerial')->with($notification);
    }
}
