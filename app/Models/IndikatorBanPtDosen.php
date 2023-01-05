<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorBanPtDosen extends Model
{
    use HasFactory;
    protected $fillable = [
        'bab_indikator_ban_pt_dosen_id', 'indikator', 'keterangan', 'skor',
    ];
}
