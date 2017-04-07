<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tennis;
use App\Football;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class FootballController extends Controller
{

	public function __construct() 
	{
	  $this->middleware('auth', ['except' => ['index', 'show', 'teamschedule', 'yearschedule']]);
	}
    
	public function index()
	{

		$teams = Team::all();

		$years = Year::all();

		$currentyear = CurrentYear::find(1)->pluck('year_id');

		$showcurrentyear = Year::where('id', $currentyear)->pluck('year');

		// return $showcurrentyear;

		$football = Football::where('year_id', $currentyear)->orderBy('date')->get();

		return view('sports.football.index', compact('football', 'teams', 'years', 'showcurrentyear'));

	}



	public function show($id)
	{
 
		$football = Football::find($id);

		// return $football;

		return view('sports.football.show', compact('football'));

	}



	public function create()
	{

		//  Display the current year
		$thecurrentyear	= CurrentYear::find(1)->pluck('year_id');

		$displayyear = Year::find($thecurrentyear);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::all();

		//  Display the game times
		$times = Time::all();

		return view('sports.football.create', compact('thecurrentyear', 'years', 'teams', 'times', 'displayyear'));

	}



	public function store(Football $football)
	{

		$this->validate(request(), [
        	'year_id' 		=> 	'required',
        	'date' 			=> 	'required',
        	'away_team'		=>	'required',
        	'home_team'		=>	'required'
    	]);
		
		Football::create([

			'year_id'					=>	request('year_id'),
			'date'						=>	request('date'),
			'scrimmage'					=>	request('scrimmage'),
			'tournament_title'			=>	request('tournament_title'),
			'away_team_id'				=>	request('away_team_id'),
			'home_team_id'				=>	request('home_team_id'),
			'time_id'					=>	request('time_id'),
			'district_game'				=>	request('district_game')

		]);

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
		$teams = Team::all();

		//  Display the game times
		$times = Time::all();

		return view('sports.football.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'football'));

	}



	public function update(Request $request, football $football)
	{

		$football->update($request->all());

		return redirect('/football/');

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



		//  Select All Teams
		$teams = Team::all();



		//  Select All Years
		$years = Year::all();



		//  Display schedule for team based on selected year
		$football = Football::join('years', 'football.year_id', 'years.id')
							->where('year_id', '=', $selectedyearid)
							->where(function ($query) use ($selectedteamid) {
						        $query->where('away_team_id', '=' , $selectedteamid)
						            ->orWhere('home_team_id', '=', $selectedteamid);
						    })
						    ->orderBy('date')
							->get();

		$region 		= Team::where('school_name', $team)->pluck('region_baseball');
		$standings		= Team::where('region_baseball', $region)->orderBy('school_name')->get();

		return view('sports.football.teamschedule', compact('football', 
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
							->where('year', '=', $year)
							->orderBy('date')
							->get();

		// return $football;

		return view('sports.football.yearschedule', compact('football', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

	}



}
