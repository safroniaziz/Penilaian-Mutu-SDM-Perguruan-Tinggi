<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirSkpTendik extends Model
{
    use HasFactory;

    protected $fillable = [
        'tendik_id',
        'nama_kegiatan',
        'ak_target',
        'kuant_target',
        'output_target',
        'kual_mutu_target',
        'satuan_waktu_target',
        'satuan_bulan_target',
        'biaya_target',
        'ak_realisasi',
        'kuant_realisasi',
        'output_realisasi',
        'kual_mutu_realisasi',
        'satuan_waktu_realisasi',
        'satuan_bulan_realisasi',
        'biaya_realisasi',
        'nilai_capaian_skp',
    ];
}
