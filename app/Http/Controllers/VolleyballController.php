<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Volleyball;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

use Session;

class VolleyballController extends Controller
{
    
	public function index()
	{

		//  Query All Teams
		$teams = Team::all();

		//  Query All Years
		$years = Year::all();

		$date = date('l d, Y');

		$yesterday = date("Y-m-d", strtotime( '-1 days' ) );
		$countYesterday = Volleyball::whereDate('date', $yesterday )->get();

		$tomorrow = date("Y-m-d", strtotime( '+1 days' ) );
		$countTomorrow = Volleyball::whereDate('date', $tomorrow )->get();

		//  Query The Current Year
		$currentyear = CurrentYear::find(1)->pluck('year_id');
		$showcurrentyear = Year::where('id', $currentyear)->pluck('year');

		//  Query All Games By The Current Year
		$volleyball = Volleyball::where('year_id', $currentyear)->orderBy('date')->select('volleyball.*')->get();

		return view('sports.volleyball.index', compact('date','countYesterday', 'countTomorrow', 'yesterday', 'tomorrow', 'volleyball', 'showcurrentyear', 'teams', 'years'));

	}



	public function show($id)
	{

 		//  Query All Games By The Game ID
		$volleyball = Volleyball::find($id);

		// return $volleyball;

		return view('sports.volleyball.show', compact('volleyball'));

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

		return view('sports.volleyball.create', compact('thecurrentyear', 'years', 'teams', 'times', 'displayyear'));

	}



	public function store(Request $request, Volleyball $volleyball)
	{

		$this->validate(request(), [
        	'year_id' 			=> 	'required',
        	'date' 				=> 	'required',
        	'away_team_id'		=>	'required',
        	'home_team_id'		=>	'required'
    	]);
		
		Volleyball::create([

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

		return redirect('/volleyball');

	}



	public function edit($id)
	{

		$volleyball = Volleyball::find($id);

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::orderBy('school_name')->get();

		//  Display the game times
		$times = Time::all();

		return view('sports.volleyball.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'volleyball'));

	}



	public function update(Request $request, volleyball $volleyball)
	{

		$volleyball->update($request->all());

		return redirect()->back();

	}



	public function delete($id)
	{
		$volleyball = Volleyball::find($id);
		$volleyball->delete();
		return redirect('/volleyball');
	}



	public function teamschedule($year, $team)
	{

		// return $year;
		$selectedyear = Year::where('year', $year)->pluck('year');
		$selectedyearid = Year::where('year', $year)->pluck('id');

		$selectedteam = Team::where('school_name', $team)->get();
		$selectedteamid	=	Team::where('school_name', $team)->pluck('id');



		//  Select All Teams
		$teams = Team::all();



		//  Select All Years
		$years = Year::all();



		//  Display schedule for team based on selected year
		$volleyball = Volleyball::join('years', 'volleyball.year_id', 'years.id')
							->select('volleyball.*')
							->where('year_id', '=', $selectedyearid)
							->where(function ($query) use ($selectedteamid) {
						        $query->where('away_team_id', '=' , $selectedteamid)
						            ->orWhere('home_team_id', '=', $selectedteamid);
						    })
						    ->orderBy('date')
							->get();

		$region 		= Team::where('school_name', $team)->pluck('region_baseball');
		$standings		= Team::where('region_baseball', $region)->orderBy('school_name')->get();

		return view('sports.volleyball.teamschedule', compact('volleyball', 
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
		$volleyball = Volleyball::join('years', 'volleyball.year_id', 'years.id')
							->select('volleyball.*')
							->where('year', '=', $year)
							->orderBy('date')
							->get();

		return view('sports.volleyball.yearschedule', compact('volleyball', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

	}



	public function apiteamschedulesummary($year, $team)
	{

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		// return $theteam;

		$volleyball = Volleyball::leftjoin('teams as home_team', 'soccer_boys.home_team_id', '=', 'home_team.id')
							->leftjoin('teams as away_team', 'soccer_boys.away_team_id', '=', 'away_team.id')
							->join('years', 'soccer_boys.year_id', '=', 'years.id')
							->join('times', 'soccer_boys.time_id', '=', 'times.id')
							->leftjoin('teams as winner', 'soccer_boys.winning_team', '=', 'winner.id')
							->leftjoin('teams as loser', 'soccer_boys.losing_team', '=', 'loser.id')
							->select(
									'soccer_boys.id',
									'soccer_boys.date',
									'year',
									'scrimmage',
									'time',
									'soccer_boys.tournament_title',
									'away_team.school_name as away_team',
									'away_team.logo as away_team_logo',
									'soccer_boys.away_team_first_half_score',
									'soccer_boys.away_team_second_half_score',
									'soccer_boys.away_team_overtime_score',
									'soccer_boys.away_team_final_score',
									'home_team.school_name as home_team',
									'home_team.logo as home_team_logo',
									'soccer_boys.home_team_first_half_score',
									'soccer_boys.home_team_second_half_score',
									'soccer_boys.home_team_overtime_score',
									'soccer_boys.home_team_final_score',
									'soccer_boys.game_status',
									'soccer_boys.minutes_remaining',
									'soccer_boys.winning_team',
									'soccer_boys.losing_team',
									'winner.school_name as winning_team',
									'loser.school_name as losing_team'
								)
							->where('year', '=', $year)
							->where('away_team_id', '=', $theteam)
    						->orWhere('home_team_id', '=', $theteam)
    						->where('date', '>=', Carbon::today()->toDateString())
    						->limit(4)
    						->orderBy('date')
					    	->get();

		return $soccer;

	}



	public function apiteamschedule($year, $team)
	{

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		$volleyball = Volleyball::leftjoin('teams as home_team', 'volleyball.home_team_id', '=', 'home_team.id')
								->leftjoin('teams as away_team', 'volleyball.away_team_id', '=', 'away_team.id')
								->join('years', 'volleyball.year_id', '=', 'years.id')
								->join('times', 'volleyball.time_id', '=', 'times.id')
								->leftjoin('teams as winner', 'volleyball.winning_team', '=', 'winner.id')
								->leftjoin('teams as loser', 'volleyball.losing_team', '=', 'loser.id')
								->select(
									'volleyball.id',
									'volleyball.date',
									'year',
									'scrimmage',
									'time',
									'volleyball.tournament_title',
									'away_team.school_name as away_team',
									'volleyball.away_team_first_game_score',
									'volleyball.away_team_second_game_score',
									'volleyball.away_team_third_game_score',
									'volleyball.away_team_fourth_game_score',
									'volleyball.away_team_fifth_game_score',
									'home_team.school_name as home_team',
									'volleyball.home_team_first_game_score',
									'volleyball.home_team_second_game_score',
									'volleyball.home_team_third_game_score',
									'volleyball.home_team_fourth_game_score',
									'volleyball.home_team_fifth_game_score',
									'volleyball.game_status',
									'volleyball.game_one_winner',
									'volleyball.game_two_winner',
									'volleyball.game_three_winner',
									'volleyball.game_four_winner',
									'volleyball.game_five_winner',
									'volleyball.winning_team',
									'volleyball.losing_team',
									'winner.school_name as winning_team',
									'loser.school_name as losing_team'
								)
							->where('year', '=', $year)
							->where('away_team_id', '=', $theteam)->orWhere('home_team_id', '=', $theteam)
					    	->get();

		return $volleyball;

	}

}
