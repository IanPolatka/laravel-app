<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Basketballgirls;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

use Session;

class BasketballgirlsController extends Controller
{
    
	public function index()
	{

		//  Query All Teams
		$teams = Team::all();

		//  Query All Years
		$years = Year::all();

		//  Query The Current Year
		$currentyear = CurrentYear::find(1)->pluck('year_id');
		$showcurrentyear = Year::where('id', $currentyear)->pluck('year');

		//  Query All Games By The Current Year
		$basketball = Basketballgirls::where('year_id', $currentyear)->orderBy('date')->select('basketball_girls.*')->get();

		return view('sports.basketball_girls.index', compact('basketball', 'showcurrentyear', 'teams', 'years'));

	}



	public function show($id)
	{

 		//  Query All Games By The Game ID
		$basketball = Basketballgirls::find($id);

		// return $basketball;

		return view('sports.basketballgirls.show', compact('basketball'));

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

		return view('sports.basketball_girls.create', compact('thecurrentyear', 'years', 'teams', 'times', 'displayyear'));

	}



	public function store(Request $request, basketballgirls $basketballgirls)
	{

		$this->validate(request(), [
        	'year_id' 			=> 	'required',
        	'date' 				=> 	'required',
        	'away_team_id'		=>	'required',
        	'home_team_id'		=>	'required'
    	]);
		
		Basketballgirls::create([

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

		return redirect('/basketball-girls');

	}



	public function edit($id)
	{

		$basketball = Basketballgirls::find($id);

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::orderBy('school_name')->get();

		//  Display the game times
		$times = Time::all();

		return view('sports.basketball_girls.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'basketball'));

	}



	public function update(Request $request, basketballgirls $basketballgirls)
	{

		$basketballgirls->update($request->all());

		return redirect()->back();

	}



	public function delete($id)
	{
		$basketball = Basketballgirls::find($id);
		$basketball->delete();
		return redirect('/basketball-girls');
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
		$basketball = Basketballgirls::join('years', 'basketball_girls.year_id', 'years.id')
							->select('basketball_girls.*')
							->where('year_id', '=', $selectedyearid)
							->where(function ($query) use ($selectedteamid) {
						        $query->where('away_team_id', '=' , $selectedteamid)
						            ->orWhere('home_team_id', '=', $selectedteamid);
						    })
						    ->orderBy('date')
							->get();

		$region 		= Team::where('school_name', $team)->pluck('region_baseball');
		$standings		= Team::where('region_baseball', $region)->orderBy('school_name')->get();

		return view('sports.basketball_girls.teamschedule', compact('basketball', 
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
		$basketball = Basketballgirls::join('years', 'basketball_girls.year_id', 'years.id')
							->select('basketball_girls.*')
							->where('year', '=', $year)
							->orderBy('date')
							->get();

		return view('sports.basketball_girls.yearschedule', compact('basketball', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

	}







	public function apiteamschedule($year, $team)
	{

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		$basketball = Basketballgirls::join('teams as home_team', 'basketball_girls.home_team_id', '=', 'home_team.id')
							->join('teams as away_team', 'basketball_girls.away_team_id', '=', 'away_team.id')
							->join('years', 'basketball_girls.year_id', '=', 'years.id')
							->join('times', 'basketball_girls.time_id', '=', 'times.id')
							->select(
									'basketball_girls.id',
									'basketball_girls.date',
									'year',
									'scrimmage',
									'time',
									'basketball_girls.tournament_title',
									'away_team.school_name as away_team',
									'basketball_girls.away_team_first_qrt_score',
									'basketball_girls.away_team_second_qrt_score',
									'basketball_girls.away_team_third_qrt_score',
									'basketball_girls.away_team_fourth_qrt_score',
									'basketball_girls.away_team_overtime_score',
									'basketball_girls.away_team_final_score',
									'home_team.school_name as home_team',
									'basketball_girls.home_team_first_qrt_score',
									'basketball_girls.home_team_second_qrt_score',
									'basketball_girls.home_team_third_qrt_score',
									'basketball_girls.home_team_fourth_qrt_score',
									'basketball_girls.home_team_overtime_score',
									'basketball_girls.home_team_final_score',
									'basketball_girls.game_status',
									'basketball_girls.minutes_remaining',
									'basketball_girls.seconds_remaining',
									'basketball_girls.winning_team',
									'basketball_girls.losing_team'
								)
							->where('year', '=', $year)
							->where('away_team_id', '=', $theteam)->orWhere('home_team_id', '=', $theteam)
					    	->get();

		return $basketball;

	}
    
}
