<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorTendikBpmAspekManajerial extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria_aspek_manajerial_id', 'indikator',
    ];
}