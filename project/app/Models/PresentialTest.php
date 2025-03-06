<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentialTest extends Model
{    
    protected $table  = 'presential_test'; 
    protected $fillable = [
    'type',
    'candidat_id',
    'staff_id',
    'date_start',
    'date_end',
     'location'
    ];

}
