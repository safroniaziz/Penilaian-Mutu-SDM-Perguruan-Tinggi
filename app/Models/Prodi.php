<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $fillable = [
        'fakultas_id','nama_prodi','jumlah_mahasiswa','jumlah_dosen'
    ];

    public function fakultas(){
        return $this->belongsTo(Unit::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
