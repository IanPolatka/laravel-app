<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Bowlingboys;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class BowlingboysController extends Controller
{

	public function index()
    {

        //  Query All Teams
        $teams = Team::all()->sortBy('school_name');

        //  Query All Years
        $years = Year::all();

        //  Query The Current Year
        $currentyear = CurrentYear::find(1)->pluck('year_id');
        $showcurrentyear = Year::where('id', $currentyear)->pluck('year');

        //  Query All Games By The Current Year
        $bowling = Bowlingboys::where('year_id', $currentyear)->orderBy('date')->select('bowling_boys.*')->get();

        return view('sports.bowling_boys.index', compact('bowling', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(bowlingboys $bowlingboys)
    {

        return view('sports.bowling_boys.show', compact('bowlingboys'));
        
    }



    public function create()
    {

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all()->sortBy('school_name');

        //  Display the game times
        $times = Time::all();

        return view('sports.bowling_boys.create', compact('thecurrentyear', 'years', 'teams', 'times'));

    }



    public function store(Request $request)
    {

        Bowlingboys::create([

            'year_id'                   =>  request('year_id'),
            'team_level'                =>  request('team_level'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'away_team_id'              =>  request('away_team_id'),
            'home_team_id'              =>  request('home_team_id'),
            'time_id'                   =>  request('time_id')

        ]);

        return redirect('/bowling-boys');

    }



    public function edit($id)
    {

        $bowling = Bowlingboys::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all()->sortBy('school_name');

        //  Display the game times
        $times = Time::all();

        return view('sports.bowling_boys.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'bowling', 'away_team'));

    }



    public function update(Request $request, bowlingboys $bowlingboys)
    {

        $bowlingboys->update($request->all());

        return redirect('/bowling-boys');

    }



    public function delete($id)
    {
        $bowling = Bowlingboys::find($id);
        $bowling->delete();
        return redirect('/bowling-boys');
    }



    public function teamschedule($year, $team)
    {

        $selectedyear = Year::where('year', $year)->pluck('year');
        $selectedyearid = Year::where('year', $year)->pluck('id');

        $selectedteam = Team::where('school_name', $team)->get();
        $selectedteamid =   Team::where('school_name', $team)->pluck('id');


        // Select All Teams
        $teams = Team::all()->sortBy('school_name');



        //  Select All Years
        $years = Year::all();



        //  Display schedule for team based on selected year
        $bowling = Bowlingboys::join('years', 'bowling_boys.year_id', 'years.id')
                            ->select('bowling_boys.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where(function ($query) use ($selectedteamid) {
                                $query->where('away_team_id', '=' , $selectedteamid)
                                    ->orWhere('home_team_id', '=', $selectedteamid);
                            })
                            ->orderBy('date')
                            ->get();



        return view('sports.bowling_boys.teamschedule', compact('bowling', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

    }



    public function yearschedule($year)
    {

        //  Get id of the selected year
        $selectedyear = Year::where('year', $year)->pluck('year');
        $selectedyearid = Year::where('year', $year)->pluck('id');



        //  Select All Teams
        $teams = Team::all()->sortBy('school_name');



        //  Select All Years
        $years = Year::all();

        //  Display schedule for team based on selected year
        $bowling = Bowlingboys::join('years', 'bowling_boys.year_id', 'years.id')
                            ->select('bowling_boys.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.bowling_boys.yearschedule', compact('bowling', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }

}
