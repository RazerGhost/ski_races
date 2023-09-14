<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Racerboard extends Model
{
    protected $table = 'racers';
    protected $fillable = [
        'voornaam',
        'achternaam',
        'geslacht',
        'geboortedatum',
        'categorie',
    ];
}
