<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doubleboard extends Model
{

    protected $table = 'doublelap';
    protected $primaryKey = 'id';
    protected $fillable = [
        'racer_id',
        'race_id',
        'firstlap',
        'secondlap',
        'averagelap',
    ];

    public function racer()
    {
        return $this->belongsTo(Racer::class);
    }

    public function races()
    {
        return $this->belongsTo(Races::class);
    }
}
