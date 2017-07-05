<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Football;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

use Session;

class FootballController extends Controller
{

	public function __construct() 
	{
	  $this->middleware('auth', ['except' => ['index', 'show', 'teamschedule', 'yearschedule']]);
	}
    
	public function index()
	{

		//  Query All Teams
		$teams = Team::orderBy('school_name')->get();

		//  Query All Years
		$years = Year::all();

		//  Query The Current Year
		$currentyear = CurrentYear::find(1)->pluck('year_id');
		$showcurrentyear = Year::where('id', $currentyear)->pluck('year');

		//  Query All Games By The Current Year
		$football = Football::where('year_id', $currentyear)->orderBy('date')->select('football.*')
					->whereDate('date', Carbon::today())
					->get();

		$date = date('l d, Y');

		$yesterday = date("Y-m-d", strtotime( '-1 days' ) );
		$countYesterday = Football::whereDate('date', $yesterday )->get();

		$tomorrow = date("Y-m-d", strtotime( '+1 days' ) );
		$countTomorrow = Football::whereDate('date', $tomorrow )->get();



		return view('sports.football.index', compact('date','countYesterday', 'countTomorrow', 'yesterday', 'tomorrow', 'football', 'showcurrentyear', 'teams', 'years'));

	}



	public function show($id)
	{

 		//  Query All Games By The Game ID
		$football = Football::find($id);

		//  Get the home team id
		$home_team = Football::where('id','=', $id)->pluck('home_team_id');

		//  Get the away team id
		$away_team = Football::where('id','=', $id)->pluck('away_team_id');

		//  Get the year of the selected game
		$selectedyearid = 	Football::where('id','=', $id)->pluck('year_id');


		//  Count Away Team Wins		
    	$away_team_wins_total = Football::where('winning_team', '=', $away_team)
    									->where('year_id', '=', $selectedyearid)
    									->get();
		$away_team_wins = $away_team_wins_total->count();

		//  Count Away Team Losses	
		$away_team_losses_total = Football::where('losing_team', '=', $away_team)
										->where('year_id', '=', $selectedyearid)
										->get();
		$away_team_losses = $away_team_losses_total->count();


		//  Count Home Team Wins		
    	$home_team_wins_total = Football::where('winning_team', '=', $home_team)
    									->where('year_id', '=', $selectedyearid)
    									->get();
		$home_team_wins = $home_team_wins_total->count();

		//  Count Home Team Losses	
		$home_team_losses_total = Football::where('losing_team', '=', $home_team)
										->where('year_id', '=', $selectedyearid)
										->get();
		$home_team_losses = $home_team_losses_total->count();



		$away_team_score_computed = 	\DB::table('football')
    				->select(\DB::raw('sum(
    							IFNULL( `football`.`away_team_first_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_second_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_third_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_fourth_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_overtime_score` , 0 )
    							)
    							AS score' 
    				))
    				->where('id', '=', $id)
    				->get()->pluck('score')->first();

    	$home_team_score_computed = 	\DB::table('football')
    				->select(\DB::raw('sum(
    							IFNULL( `football`.`home_team_first_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_second_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_third_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_fourth_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_overtime_score` , 0 )
    							)
    							AS score' 
    				))
    				->where('id', '=', $id)
    				->get()->pluck('score')->first();

		return view('sports.football.show', compact('away_team_wins', 'away_team_losses', 'home_team_wins', 'home_team_losses', 'away_team_score_computed', 'home_team_score_computed' , 'football'));

	}



	public function create()
	{

		//  Display the current year
		$thecurrentyear	= CurrentYear::find(1)->pluck('year_id');

		$displayyear = Year::find($thecurrentyear);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::orderBy('school_name')->get();

		//  Display the game times
		$times = Time::all();

		return view('sports.football.create', compact('thecurrentyear', 'years', 'teams', 'times', 'displayyear'));

	}



	public function store(Request $request, Football $football)
	{

		$this->validate(request(), [
        	'year_id' 			=> 	'required',
        	'date' 				=> 	'required',
        	'away_team_id'		=>	'required',
        	'home_team_id'		=>	'required'
    	]);
		
		Football::create([

			'year_id'					=>	request('year_id'),
			'team_level'				=>  request('team_level'),
			'date'						=>	request('date'),
			'scrimmage'					=>	request('scrimmage'),
			'tournament_title'			=>	request('tournament_title'),
			'away_team_id'				=>	request('away_team_id'),
			'home_team_id'				=>	request('home_team_id'),
			'time_id'					=>	request('time_id'),
			'district_game'				=>	request('district_game')

		]);

		Session::flash('success', 'Game Has Been Added');

		return redirect('/football');

	}



	public function edit($id)
	{

		$football = Football::find($id);

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::orderBy('school_name')->get();

		//  Display the game times
		$times = Time::all();



		//  Get the home team id
		$home_team = Football::where('id','=', $id)->pluck('home_team_id');

		//  Get the away team id
		$away_team = Football::where('id','=', $id)->pluck('away_team_id');

		//  Get the year of the selected game
		$selectedyearid = 	Football::where('id','=', $id)->pluck('year_id');



		//  Count Away Team Wins		
    	$away_team_wins_total = Football::where('winning_team', '=', $away_team)
    									->where('year_id', '=', $selectedyearid)
    									->get();
		$away_team_wins = $away_team_wins_total->count();

		//  Count Away Team Losses	
		$away_team_losses_total = Football::where('losing_team', '=', $away_team)
										->where('year_id', '=', $selectedyearid)
										->get();
		$away_team_losses = $away_team_losses_total->count();


		//  Count Home Team Wins		
    	$home_team_wins_total = Football::where('winning_team', '=', $home_team)
    									->where('year_id', '=', $selectedyearid)
    									->get();
		$home_team_wins = $home_team_wins_total->count();

		//  Count Home Team Losses	
		$home_team_losses_total = Football::where('losing_team', '=', $home_team)
										->where('year_id', '=', $selectedyearid)
										->get();
		$home_team_losses = $home_team_losses_total->count();



		$away_team_score_computed = 	\DB::table('football')
    				->select(\DB::raw('sum(
    							IFNULL( `football`.`away_team_first_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_second_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_third_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_fourth_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_overtime_score` , 0 )
    							)
    							AS score' 
    				))
    				->where('id', '=', $id)
    				->get()->pluck('score')->first();

    	$home_team_score_computed = 	\DB::table('football')
    				->select(\DB::raw('sum(
    							IFNULL( `football`.`home_team_first_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_second_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_third_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_fourth_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_overtime_score` , 0 )
    							)
    							AS score' 
    				))
    				->where('id', '=', $id)
    				->get()->pluck('score')->first();


		return view('sports.football.edit', compact('away_team_wins', 'away_team_losses', 'home_team_wins', 'home_team_losses', 'away_team_score_computed', 'home_team_score_computed', 'years', 'thecurrentyear', 'teams', 'times', 'football'));

	}



	public function update(Request $request, football $football)
	{

		$football->update($request->all());

		Session::flash('success', 'Game Updated');

		return redirect()->back();

	}



	public function delete($id)
	{
		$football = Football::find($id);
		$football->delete();
		return redirect('/football');
	}



	public function teamschedule($year, $team)
	{

		// return $year;
		$selectedyear = Year::where('year', $year)->pluck('year');
		$selectedyearid = Year::where('year', $year)->pluck('id');

		$selectedteam = Team::where('school_name', $team)->get();
		$selectedteamid	=	Team::where('school_name', $team)->pluck('id');
		$selectedFootballClass = Team::where('school_name', $team)->pluck('class_football');



		//  Select All Teams
		$teams = Team::all();



		//  Select All Years
		$years = Year::all();



		//  Display schedule for team based on selected year
		$football = Football::join('years', 'football.year_id', 'years.id')
							->select('football.*')
							->where('year_id', '=', $selectedyearid)
							->where(function ($query) use ($selectedteamid) {
						        $query->where('away_team_id', '=' , $selectedteamid)
						            ->orWhere('home_team_id', '=', $selectedteamid);
						    })
						    ->orderBy('date')
							->get();

		$away_team_score_computed = 	\DB::table('football')
    				->select(\DB::raw('sum(
    							IFNULL( `football`.`away_team_first_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_second_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_third_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_fourth_qrt_score` , 0 ) +
    							IFNULL( `football`.`away_team_overtime_score` , 0 )
    							)
    							AS score' 
    				))
    				->get()->pluck('score')->first();

    	$home_team_score_computed = 	\DB::table('football')
    				->select(\DB::raw('sum(
    							IFNULL( `football`.`home_team_first_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_second_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_third_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_fourth_qrt_score` , 0 ) +
    							IFNULL( `football`.`home_team_overtime_score` , 0 )
    							)
    							AS score' 
    				))
    				->get()->pluck('score')->first();

    	
    	//  Count All Wins		
    	$winning_team_by_id = Football::where('winning_team', '=', $selectedteamid)
    									->where('year_id', '=', $selectedyearid)
    									->get();
		$wins = $winning_team_by_id->count();

		//  Count All District Wins
		$district_wins_by_team_id = Football::where('winning_team', '=', $selectedteamid)
											->where('district_game', '=', 1)
											->where('year_id', '=', $selectedyearid)
											->get();
		$district_wins = $district_wins_by_team_id->count();

		//  Count All Losses	
		$losing_team_by_id = Football::where('losing_team', '=', $selectedteamid)
										->where('year_id', '=', $selectedyearid)
										->get();
		$losses = $losing_team_by_id->count();


		//  Count All District losses
		$district_losses_by_team_id = Football::where('losing_team', '=', $selectedteamid)
											->where('district_game', '=', 1)
											->where('year_id', '=', $selectedyearid)
											->get();
		$district_losses = $district_losses_by_team_id->count();



		$district 		= Team::where('school_name', $team)->pluck('district_football');
		$standings		= Team::where('district_football', $district)
								->where('class_football', $selectedFootballClass)
								->orderBy('school_name')->get();

		return view('sports.football.teamschedule', compact('losses',
															'wins',
															'district_wins',
															'district_losses',
															'away_team_score_computed',
															'home_team_score_computed',
															'football', 
															'selectedteam',
															'selectedteamid',
															'selectedyear',
															'selectedyearid',
															'standings',
															'teams',
															'year',
															'years'
															));

	}



	public function yearschedule($year)
	{

		//  Get id of the selected year
		$selectedyear = Year::where('year', $year)->pluck('year');
		$selectedyearid = Year::where('year', $year)->pluck('id');



		//  Select All Teams
		$teams = Team::all();



		//  Select All Years
		$years = Year::all();

		//  Display schedule for team based on selected year
		$football = Football::join('years', 'football.year_id', 'years.id')
							->select('football.*')
							->where('year', '=', $year)
							->orderBy('date')
							->get();

		return view('sports.football.yearschedule', compact('football', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

	}







	public function apiteamschedule($year, $team)
	{

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		$football = Football::join('teams as home_team', 'football.home_team_id', '=', 'home_team.id')
							->join('teams as away_team', 'football.away_team_id', '=', 'away_team.id')
							->join('years', 'football.year_id', '=', 'years.id')
							->join('times', 'football.time_id', '=', 'times.id')
							->select(
									'football.id',
									'football.date',
									'year',
									'scrimmage',
									'time',
									'football.tournament_title',
									'away_team.school_name as away_team',
									'football.away_team_first_qrt_score',
									'football.away_team_second_qrt_score',
									'football.away_team_third_qrt_score',
									'football.away_team_fourth_qrt_score',
									'football.away_team_overtime_score',
									'football.away_team_final_score',
									'home_team.school_name as home_team',
									'football.home_team_first_qrt_score',
									'football.home_team_second_qrt_score',
									'football.home_team_third_qrt_score',
									'football.home_team_fourth_qrt_score',
									'football.home_team_overtime_score',
									'football.home_team_final_score',
									'football.game_status',
									'football.minutes_remaining',
									'football.seconds_remaining',
									'football.winning_team',
									'football.losing_team'
								)
							->where('year', '=', $year)
							->where('away_team_id', '=', $theteam)->orWhere('home_team_id', '=', $theteam)
					    	->get();

		return $football;

	}

}
