<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaTendikBpmAspekTeknis extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria',
    ];

    public function indikators(){
        return $this->hasMany(IndikatorTendikBpmAspekTeknis::class, 'kriteria_aspek_teknis_id');
    }
}
