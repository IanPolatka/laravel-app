<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tennis;
use App\Year;
use App\CurrentYear;
use App\Time;

class Tennis extends Model
{

	protected $table = 'tennis';

	public function team()
    {
    	return $this->belongsTo('App\Team');
    }

    public function year()
    {
    	return $this->belongsTo('App\Year');
    }
    
	protected $fillable = [

        'school_year_id',
        'team_id',
        'date',
        'scrimmage',
        'tournament_title',
        'is_away',
        'opponent_id',
        'time_id',
        'boys_win_lose',
        'boys_match_score',
        'girls_won_lose',
        'girls_match_score'

    ];

}
