<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Crosscountry;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class CrosscountryController extends Controller
{
    
	public function index()
    {

        //  Query All Years
        $years = Year::all();

        //  Query All Teams
        $teams = Team::all();

        //  Query The Current Year
        $currentyear = CurrentYear::find(1)->pluck('year_id');
        $showcurrentyear = Year::where('id', $currentyear)->pluck('year');

        //  Query All Games By The Current Year
        $crosscountry = Crosscountry::where('year_id', $currentyear)->orderBy('date')->select('cross_country.*')->get();

        return view('sports.cross_country.index', compact('crosscountry', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(crosscountry $crosscountry)
    {

        return view('sports.cross_country.show', compact('crosscountry'));
        
    }



    public function create()
    {

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all the teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.cross_country.create', compact('thecurrentyear', 'years', 'times', 'teams'));

    }



    public function store(Request $request)
    {

        Crosscountry::create([

            'team_id'                   =>  request('team_id'),
            'team_level'                =>  request('team_level'),
            'year_id'                   =>  request('year_id'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'time_id'                   =>  request('time_id'),
            'boys_result'               =>  request('boys_result'),
            'girls_result'				=>	request('girls_result')

        ]);

        return redirect('/cross-country');

    }



    public function edit($id)
    {

        $crosscountry = Crosscountry::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.cross_country.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'crosscountry'));

    }



    public function update(Request $request, crosscountry $crosscountry)
    {

        $crosscountry->update($request->all());

        return redirect('/cross-country');

    }



    public function delete($id)
    {
        $crosscountry = Crosscountry::find($id);
        $crosscountry->delete();
        return redirect('/cross-country');
    }



    public function teamschedule($year, $team)
    {

        $selectedyear = Year::where('year', $year)->pluck('year');
        $selectedyearid = Year::where('year', $year)->pluck('id');

        $selectedteam = Team::where('school_name', $team)->get();
        $selectedteamid =   Team::where('school_name', $team)->pluck('id');


        // Select All Teams
        $teams = Team::all();



        //  Select All Years
        $years = Year::all();



        //  Display schedule for team based on selected year
        $crosscountry = Crosscountry::join('years', 'cross_country.year_id', 'years.id')
                            ->select('cross_country.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where('team_id', '=', $selectedteamid)
                            ->orderBy('date')
                            ->get();



        return view('sports.cross_country.teamschedule', compact('crosscountry', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

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
        $crosscountry = Crosscountry::join('years', 'cross_country.year_id', 'years.id')
                            ->select('cross_country.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.cross_country.yearschedule', compact('crosscountry', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }

}
