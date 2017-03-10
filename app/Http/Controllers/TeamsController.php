<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Team;

class TeamsController extends Controller
{
    
	public function index()
	{

		$teams = Team::all();

		return view('teams.index', compact('teams'));

	}



	public function show(Team $team)
	{

		return view('teams.show', compact('team'));
		
	}



	public function create()
	{

		return view('teams.create');

	}



	public function store(Team $team)
	{

		Team::create([

			'school_name'			=>	request('school_name'),
			'mascot'				=>	request('mascot'),
			'state'					=>	request('state'),
			'city'					=>	request('city'),
			'region_baseball'		=>	request('region_baseball'),
			'district_baseball'		=>	request('district_baseball'),
			'region_basketball'		=>	request('region_basketball'),
			'district_basketball'	=>	request('district_basketball'),
			'region_football'		=>	request('region_football'),
			'district_football'		=>	request('district_football'),
			'region_soccer'			=>	request('region_soccer'),
			'district_soccer'		=>	request('district_soccer'),
			'region_volleyball'		=>	request('region_volleyball'),
			'district_volleyball'	=>	request('district_volleyball')

		]);

		return redirect('/teams');

	}



	public function edit(Team $team)
	{

		return view('teams.edit', compact('team'));

	}



	public function update(Request $request, Team $team)
	{

		$team->update($request->all());

		return redirect('/teams');

	}



	public function delete(Team $team)
	{

		$team = Team::find($team);

		$team->delete();

		return redirect('/teams');

	}

}
