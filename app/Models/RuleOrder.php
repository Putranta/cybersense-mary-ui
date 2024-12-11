<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleOrder extends Model
{
    protected $table = 'rule_order';
    protected $fillable = [
        'rule_base_id',
        'kriteria_detail_id'
    ];

    public function kriteriaDetail()
    {
        return $this->belongsTo(KriteriaDetail::class, 'kriteria_detail_id');
    }
}
