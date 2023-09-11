<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaceBoard extends Model
{
    protected $table = 'racers';
    protected $fillable = [
        'id',
        'voornaam',
        'achternaam',
        'geslacht',
        'geboortedatum',
        'categorie',
    ];
    protected $table2 = 'doublelap';
    protected $fillable2 = [
        'id',
        'racer_id',
        'firstlap',
        'secondlap',
    ];
    protected $table3 = 'triplelap';
    protected $fillable3 = [
        'id',
        'racer_id',
        'firstlap',
        'secondlap',
        'thirdlap',
    ];
}
