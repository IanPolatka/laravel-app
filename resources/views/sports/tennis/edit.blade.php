@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create</div>

                <div class="panel-body">
                    <form method="POST" action="/tennis">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

                        <div class="form-group">

                          <label for="team_id">Which Team Is This Match For?</label>

                          <select name="team_id" id="team_id" class="form-control">

                            @foreach($teams as $team)

                              <option value="{{ $team->id }}" @if ($tennis->team_id === $team->id) selected @endif > {{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  --> 

                        <div class="form-group">

                          <label for="school_year_id">What Year Is This Match For?</label>

                          <select name="school_year_id" id="school_year_id" class="form-control">

                            <option value="">Select A School Year</option>

                            <option value="{{ $thecurrentyear->id }}">{{ $thecurrentyear->year }}</option>

                            <option value="">---------------------</option>

                            @foreach($years as $year)

                              <option value="{{ $year->id }}" @if ($tennis->year_id === $year->id) selected @endif >
                                
                                  {{ $year->year }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="text" class="form-control" id="datepicker" name="date">
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($tennis->scrimmage === "0") selected @endif >No</option>
                              <option value="1" @if ($tennis->scrimmage === "1") selected @endif >Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $tennis->tournament_title }}">
                        </div>

                        <div class="form-group">

                          <label for="is_away">Is This Match Away?</label>

                          <select name="is_away" id="is_away" class="form-control">
                              <option value="0" @if ($tennis->is_away === "0") selected @endif >No</option>
                              <option value="1" @if ($tennis->is_away === "1") selected @endif >Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="opponent_id">Who Is The Opponent?</label>

                          <select name="opponent_id" id="opponent_id" class="form-control">

                            @foreach($teams as $team)

                              <option value="{{ $team->id }}" @if ($tennis->opponent_id === $team->id) selected @endif > {{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  --> 
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($tennis->time_id === $time->id) selected @endif > {{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="boys_win_lose">Did The Boys Win?</label>

                          <select name="boys_win_lose" id="boys_win_lose" class="form-control">
                            <option value="" @if ($tennis->boys_win_lose === "") selected @endif >Select An Option</option>
                            <option value="0" @if ($tennis->boys_win_lose === "0") selected @endif >No</option>
                            <option value="1" @if ($tennis->boys_win_lose === "1") selected @endif >>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="boys_match_score">What Was The Match Score?</label>
                          <input type="text" class="form-control" id="boys_match_score" name="boys_match_score" value="{{ $tennis->boys_match_score}}">
                        </div>

                        <div class="form-group">

                          <label for="girls_win_lose">Did The Girls Win?</label>

                          <select name="girls_win_lose" id="girls_win_lose" class="form-control">
                            <option value="" @if ($tennis->girls_win_lose === "") selected @endif >Select An Option</option>
                            <option value="0" @if ($tennis->girls_win_lose === "0") selected @endif >No</option>
                            <option value="1" @if ($tennis->girls_win_lose === "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="girls_match_score">What Was The Match Score?</label>
                          <input type="text" class="form-control" id="girls_match_score" name="girls_match_score" value="{{ $tennis->girls_match_score}}">
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Create School</button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
