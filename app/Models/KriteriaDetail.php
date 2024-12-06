<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaDetail extends Model
{
    protected $fillable = [
        'kode',
        'name',
        'kriteria_id',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function ruleBases()
    {
        return $this->belongsToMany(RuleBase::class, 'rule_order', 'kriteria_detail_id', 'rule_base_id')
            ->withTimestamps(); // Jika ingin mencatat waktu relasi dibuat
    }

    public function kriteriaDetails()
    {
        return $this->belongsToMany(LogPengguna::class, 'input_penggunas', 'kriteria_detail_id', 'log_pengguna_id')
            ->withTimestamps();
    }
}
