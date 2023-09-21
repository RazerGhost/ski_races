<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doubleboard extends Model
{

    protected $table = 'doublelap';
    protected $fillable = [
        'racer_id',
        'firstlap',
        'secondlap',
        'averagelap',
    ];
}
