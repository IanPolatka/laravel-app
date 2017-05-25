<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crosscountry extends Model
{
    
	protected $table = 'cross_country';

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
        'year_id',
        'date',
        'scrimmage',
        'tournament_title',
        'time_id',
        'boys_result',
        'girls_result'

    ];

}
