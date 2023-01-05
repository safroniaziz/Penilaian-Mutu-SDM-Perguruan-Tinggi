<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilReviewBanPtTendik extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reviewer(){
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function getTotalKeseluruhanAttribute(){
        return $this->sum('total');
    }

    public function pegawai(){
        return $this->belongsTo(Tendik::class ,'pegawai_id');
    }
}
