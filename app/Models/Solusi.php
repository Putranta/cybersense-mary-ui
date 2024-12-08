<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    protected $table = 'solusi';
    protected $fillable = [
        'kode',
        'kategori_resiko',
        'total_skor_resiko',
        'deskripsi',
    ];

    public function ruleBases()
    {
        return $this->hasMany(RuleBase::class, 'solusi_id');
    }
}
