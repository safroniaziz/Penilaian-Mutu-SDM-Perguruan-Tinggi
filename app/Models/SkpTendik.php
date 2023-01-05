<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkpTendik extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tendik(){
        return $this->belongsTo(Tendik::class);
    }

    public function penilai(){
        return $this->belongsTo(Tendik::class , 'pejabat_penilai_id');
    }
    public function penilaiDosen(){
        return $this->belongsTo(Dosen::class , 'pejabat_penilai_id');
    }

    public function atasanPenilai(){
        return $this->belongsTo(Tendik::class, 'atasan_pejabat_penilai_id');
    }

    public function atasanPenilaiDosen(){
        return $this->belongsTo(Dosen::class, 'atasan_pejabat_penilai_id');
    }

    public function skpDetails(){
        return $this->hasMany(SkpTendikDetail::class);
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
