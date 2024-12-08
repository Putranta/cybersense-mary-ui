<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $fillable = [
        'name',
        'slug',
        'bobot',
    ];

    public function kriteriaDetails()
    {
        return $this->hasMany(KriteriaDetail::class, 'kriteria_id');
    }
}
