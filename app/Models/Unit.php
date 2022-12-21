<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_unit','jenis_unit','nama_singkatan'
    ];

    public function prodis(){
        return $this->hasMany(Prodi::class);
    }

    public function getTotalProdiAttribute(){
        return $this->prodis()->count('id');
    }

    public function tendiks(){
        return $this->hasMany(Tendik::class);
    }

    public function getJumlahTendikAttribute(){
        return $this->tendiks()->sum('id');
    }
}
