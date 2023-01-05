<?php

namespace App\Models;

use App\Http\Controllers\Lpmpp\ReviewerIndikatorBanPt;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unit_id',
        'prodi_id',
        'nama_lengkap',
        'nip',
        'nidn',
        'akses',
        'password',
        'pangkat',
        'golongan',
        'ttl',
        's1',
        's2',
        's3',
        'ilmu',
        'no_hp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function prodi(){
        return $this->belongsTo(Prodi::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function bkdPendidikans(){
        return $this->hasMany(BkdPendidikan::class);
    }

    public function reviewer(){
        if (strlen($this->nip)>5) {
            return $this->belongsTo(Dosen::class, 'id');
        }else{
            return $this->belongsTo(Tendik::class ,'nip');
        }
    }

    public function hasilReviewBanPtDosen(){
        return $this->hasOne(HasilReviewBanPtDosen::class ,'reviewer_id');
    }

    public function reviewerBanPtDosen(){
        return $this->hasOne(ReviewerBanPt::class ,'reviewer_id');
    }

    public function hasilReviewTeknisTendik(){
        return $this->hasOne(HasilReviewTeknisTendik::class ,'reviewer_id');
    }

    public function reviewerTeknisTendik(){
        return $this->hasOne(ReviewerIndikatorTeknis::class ,'reviewer_id');
    }

    public function hasilReviewManajerialTendik(){
        return $this->hasOne(HasilReviewManajerialTendik::class ,'reviewer_id');
    }

    public function reviewerManajerialTendik(){
        return $this->hasOne(ReviewerIndikatorManajerial::class ,'reviewer_id');
    }

    public function hasilReviewBanPtTendik(){
        return $this->hasOne(HasilReviewBanPtTendik::class ,'reviewer_id');
    }

    public function reviewerBanPtTendik(){
        return $this->hasOne(ReviewerIndikatorBanPtTendik::class ,'reviewer_id');
    }
}
