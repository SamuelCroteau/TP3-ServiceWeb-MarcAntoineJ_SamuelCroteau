<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'average_score',
        'total_votes',
        'film_id',
    ];
    public function films() 
    {
        return $this->hasOne('App\Models\Film');
    }
    public function critics() 
    {
        return $this->hasOne('App\Models\Critic');
    }
}
