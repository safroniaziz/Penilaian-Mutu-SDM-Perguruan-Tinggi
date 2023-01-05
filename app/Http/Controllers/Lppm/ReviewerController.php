<?php

namespace App\Http\Controllers\Lppm;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Tendik;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index(){
        $reviewers = User::where('akses', 'reviewer')->get();
        return view('lpmpp/reviewers.index',compact('reviewers'));
    }

    public function add(){
        $dosens = Dosen::select('id','nama_dosen as nama_pejabat')->get()->toArray();
        $tendiks = Tendik::select('id','nama_tendik as nama_pejabat')->get()->toArray();
        $reviewers = array_merge($dosens,$tendiks);
        return view('lpmpp/reviewers.add',[
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

        if (strlen($request->reviewer_id)>5) {
            $nip = Dosen::where('id',$request->reviewer_id)->first();
            $unit_id = $nip->prodi->unit_id;
            $nip2 = Dosen::select('id as nip','nama_dosen as nama_reviewer','golongan')->where('id',$request->reviewer_id)->first();
        }else{
            $nip = Tendik::with('unit')->where('id',$request->reviewer_id)->first();
            $unit_id = $nip->unit_id;
            $nip2 = Tendik::select('nip as nip','nama_tendik as nama_reviewer','golongan')->where('id',$request->reviewer_id)->first();
        }
        User::create([
            'unit_id'         =>  $unit_id,
            'nama_lengkap'    =>  $nip2->nama_reviewer,
            'nip'        =>  $nip2->nip,
            'nidn'        =>  $nip2->nip,
            'akses'     =>  'reviewer',
            'golongan'        =>  $nip2->golongan,
            'password'      =>  bcrypt('password'),
        ]);

        $notification = array(
            'message' => 'Berhasil, data reviewers berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.reviewers')->with($notification);
    }
    
    public function delete($id){
        User::where('id',$id)->delete();
        $notification = array(
            'message' => ' data reviewer berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('lpmpp.reviewers')->with($notification);
    }
}
