<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaTendikBpmAspekManajerial extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria',
    ];

    public function indikators(){
        return $this->hasMany(IndikatorTendikBpmAspekManajerial::class, 'kriteria_aspek_manajerial_id');
    }
}
