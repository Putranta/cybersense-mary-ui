<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPengguna extends Model
{
    protected $fillable = [
        'name',
        'umur',
        'no_hp',
        'umkm_name',
        'provinsi',
        'kabupaten',
        'solusi_id',
    ];

    public function solusi()
    {
        return $this->belongsTo(Solusi::class, 'solusi_id');
    }

    public function kriteriaDetails()
    {
        return $this->belongsToMany(KriteriaDetail::class, 'input_penggunas', 'log_pengguna_id', 'kriteria_detail_id')
            ->withTimestamps();
    }
}
