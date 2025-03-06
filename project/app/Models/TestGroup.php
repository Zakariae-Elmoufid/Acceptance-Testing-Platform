<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TestGroup extends Model
{
    protected  $fillable = ['candidat_id','date_start','date_end','occupied'];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];

    public function candidats()
    {
        return $this->belongsTo(Candidat::class);
    }


}
