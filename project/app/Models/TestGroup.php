<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TestGroup extends Model
{
    protected  $fillable = ['candidat_id','start_date','end_date','occupied'];

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }

    
}
