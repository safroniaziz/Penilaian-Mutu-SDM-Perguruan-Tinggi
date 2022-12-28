<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_id','nama_prodi','jumlah_mahasiswa','jumlah_dosen'
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function mahasiswas(){
        return $this->hasMany(Mahasiswa::class);
    }

    public function dosens(){
        return $this->hasMany(Dosen::class);
    }

    public function getJumlahMahasiswaAttribute(){
        return $this->mahasiswas()->count('id');
    }

    public function getJumlahDosenAttribute(){
        return $this->dosens()->count('id');
    }
}
