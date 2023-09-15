<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tripleboard extends Model
{
    protected $table = 'triplelap';
    protected $fillable = [
        'racer_id',
        'firstlap',
        'secondlap',
        'thirdlap',
    ];
}
