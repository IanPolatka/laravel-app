<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swimming extends Model
{
    
	protected $table = 'swimming';

    public function year()
    {
        return $this->belongsTo('App\Year');
    }

    public function currentyear()
    {
        return $this->belongsTo('App\CurrentYear', 'year_id');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
    }
    
    protected $fillable = [

        'team_id',
        'team_level',
        'year_id',
        'date',
        'scrimmage',
        'tournament_title',
        'time_id',
        'boys_result',
        'girls_result'

    ];

}
