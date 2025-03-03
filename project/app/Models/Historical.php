<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historical extends Model
{

    protected $table = 'historicals';
    protected $fillable = [
        'answer_id',
        'candidat_id',
    ];
    
}