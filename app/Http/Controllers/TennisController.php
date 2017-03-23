<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tennis;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;



class TennisController extends Controller
{
    
	public function index()
	{

		$todaysmatch = Tennis::whereDate('date', '=', Carbon::today()->toDateString())->get();

		$tennis = Tennis::all();

		return view('sports.tennis.index', compact('tennis', 'todaysmatch'));

	}



	public function show(tennis $tennis)
	{

		return view('sports.tennis.show', compact('tennis'));
		
	}



	public function create()
	{

		//  Display the current year
		$currentyear = \DB::table('current_year')->pluck('year_id');
		$thecurrentyear	= Year::find($currentyear);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::all();

		//  Display the game times
		$times = Time::all();

		return view('sports.tennis.create', compact('years', 'thecurrentyear', 'teams', 'times'));

	}



	public function store(Tennis $tennis)
	{

		Tennis::create([

			'school_year_id'			=>	request('school_year_id'),
			'team_id'					=>	request('team_id'),
			'date'						=>	request('date'),
			'scrimmage'					=>	request('scrimmage'),
			'tournament_title'			=>	request('tournament_title'),
			'is_away'					=>	request('is_away'),
			'opponent_id'				=>	request('opponent_id'),
			'time_id'					=>	request('time_id'),
			'boys_win_lose'				=>	request('boys_win_lose'),
			'boys_match_score'			=>	request('boys_match_score'),
			'girls_win_lose'			=>	request('girls_win_lose'),
			'girls_match_score'			=>	request('girls_match_score')

		]);

		return redirect('/tennis');

	}



	public function edit(tennis $tennis)
	{

		//  Display the current year
		$currentyear = \DB::table('current_year')->pluck('year_id');
		$thecurrentyear	= Year::find($currentyear);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::all();

		//  Display the game times
		$times = Time::all();

		return view('sports.tennis.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'tennis'));

	}



	public function update()
	{



	}



	public function delete()
	{



	}

}
