<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputPengguna extends Model
{
    protected $table = 'input_pengguna';
    protected $fillable = [
        'log_pengguna_id',
        'kriteria_detail_id',
        'value'
    ];


    public function kriteriaDetail()
    {
        return $this->belongsTo(KriteriaDetail::class, 'kriteria_detail_id');
    }
}
