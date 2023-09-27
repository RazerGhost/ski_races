<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Racesboard extends Model
{
    protected $table = 'races';
    protected $fillable = [
        'title',
        'description',
        'format',
        'location',
        'date',
        'racers',
    ];

    public function setRacersAttribute($value)
    {
        $this->attributes['racers'] = json_encode($value);
    }

    public function getRacersAttribute($value)
    {
        return $this->attributes['racers'] = json_decode($value);
    }
}
