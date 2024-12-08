<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleBase extends Model
{
    protected $table = 'rule_base';
    protected $fillable = [
        'kode',
        'solusi_id',
        'pemilik_case',
    ];

    public function solusi()
    {
        return $this->belongsTo(Solusi::class, 'solusi_id');
    }

    public function kriteriaDetails()
    {
        return $this->belongsToMany(KriteriaDetail::class, 'rule_order', 'rule_base_id', 'kriteria_detail_id')
            ->withTimestamps();
    }
}
