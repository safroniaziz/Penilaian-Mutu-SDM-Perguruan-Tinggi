<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prodi(){
        return $this->belongsTo(Prodi::class);
    }

    public function dosenPa(){
        return $this->belongsTo(DosenPa::class);
    }

    public function dosenRiwayatGolongan(){
        return $this->belongsTo(DosenRiwayatGolongan::class);
    }
}
