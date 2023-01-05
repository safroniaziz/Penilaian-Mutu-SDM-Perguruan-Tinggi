<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkpDosen extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function dosen(){
        return $this->belongsTo(Dosen::class);
    }

    public function penilai(){
        return $this->belongsTo(Dosen::class , 'pejabat_penilai_id');
    }

    public function atasanPenilai(){
        return $this->belongsTo(Dosen::class, 'atasan_pejabat_penilai_id');
    }

    public function skpDetails(){
        return $this->hasMany(SkpDosenDetail::class);
    }

    public function getJumlahAngkaAttribute(){
        return $this->skpDetails()->sum('angka');
    }

    public function getTotalAngkaAttribute(){
        return $this->skpDetails()->count('angka');
    }

    public function getRataRataAngkaAttribute(){
        return $this->jumlah_angka/$this->total_angka;
    }

}
