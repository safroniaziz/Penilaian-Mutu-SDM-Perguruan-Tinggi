<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BabIndikatorBanPtDosen extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_bab'
    ];

    public function indikators(){
        return $this->hasMany(IndikatorBanPtDosen::class, 'bab_indikator_ban_pt_dosen_id');
    }
}
