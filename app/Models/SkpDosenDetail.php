<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkpDosenDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function skpDetails()
    {
        return $this->belongsTo(SkpDosen::class);
    }

    public function ikkPimpinan(){
        return $this->belongsTo(IkkPimpinan::class);
    }

    public function getJudulIkkAttribute(){
        return $this->ikkPimpinan('judul_ikk');
    }
}