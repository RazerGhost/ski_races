<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tripleboard extends Model
{
    protected $table = 'triplelap';
    protected $primaryKey = 'id';
    protected $fillable = [
        'racer_id',
        'race_id',
        'firstlap',
        'secondlap',
        'thirdlap',
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
