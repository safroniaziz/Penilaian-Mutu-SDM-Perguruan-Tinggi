<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewerIndikatorManajerial extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function reviewer(){
        return $this->belongsTo(User::class,'reviewer_id');
    }
}
