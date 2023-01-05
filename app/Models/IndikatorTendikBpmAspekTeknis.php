<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorTendikBpmAspekTeknis extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria_aspek_teknis_id', 'indikator',
    ];

    public function kriteria(){
        return $this->belongsTo(KriteriaTendikBpmAspekTeknis::class, 'kriteria_aspek_teknis_id');
    }
}
