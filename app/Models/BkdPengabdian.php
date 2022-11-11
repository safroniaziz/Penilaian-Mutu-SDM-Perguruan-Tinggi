<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkdPengabdian extends Model
{
    use HasFactory;
    protected $fillable = [
        'dosen_id',
        'jenis_kegiatan',
        'bukti_penugasan',
        'sks_beban_kerja',
        'masa_tugas',
        'bukti_dokumen',
        'persentase_capaian',
        'sks_kinerja',
    ];

    public function dosen(){
        return $this->belongsTo(User::class,'dosen_id');
    }
}
