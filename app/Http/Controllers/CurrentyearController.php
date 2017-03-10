<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CurrentYear;


class CurrentyearController extends Controller
{
    
	public function index()
	{

		$year = \DB::table('current_year')->pluck('year_id');

		$currentyear = CurrentYear::find($year);

		return view('currentyear.index', compact('currentyear'));

	}

	public function show(CurrentYear $currentyear)
	{

		return view('currentyear.show', compact('currentyear'));
		
	}

}
