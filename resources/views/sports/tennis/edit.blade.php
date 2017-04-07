@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Match</div>

                <div class="panel-body">
                    <form method="POST" action="/tennis/{{ $tennis->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

                        <div class="form-group">

                          <label for="year_id">What Year Is This Match For?</label>

                          <select name="year_id" id="year_id" class="form-control">

                            <option value="">Select A School Year</option>

                            <option value="{{ $thecurrentyear['id'] }}">{{ $thecurrentyear['year'] }}</option>

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
                          <input type="text" class="form-control" id="datepicker" name="date" value="{{ $tennis->date }}">
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($tennis->scrimmage === "0") selected @endif>No</option>
                              <option value="1" @if ($tennis->scrimmage === "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $tennis->tournament_title }}">
                        </div>

                        <div class="form-group">

                          <label for="away_team_id">Away Team</label>

                          <select name="away_team_id" id="away_team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team->id }}" @if ($tennis->away_team_id === $team->id) selected @endif>{{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_id">Home Team</label>

                          <select name="home_team_id" id="home_team_id" class="form-control">

                            <option value="null">Please Select An Home School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team->id }}" @if ($tennis->home_team_id === $team->id) selected @endif>{{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  --> 
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($tennis->time_id === $time->id) selected @endif>{{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="boys_winner">Did The Boys Win?</label>

                          <select name="boys_winner" id="boys_winner" class="form-control">
                            <option value="">Select An Option</option>
                            <option value="{{ $tennis->away_team_id }}" @if ($tennis->boys_winner === $tennis->away_team_id) selected @endif>
                               {{ $tennis->away_team->school_name }}
                            </option>
                            <option value="{{ $tennis->home_team_id }}" @if ($tennis->boys_winner === $tennis->home_team_id) selected @endif>
                              {{ $tennis->home_team->school_name }}
                            </option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="boys_match_score">What Was The Match Score?</label>
                          <input type="text" class="form-control" id="boys_match_score" name="boys_match_score" value="{{ $tennis->boys_match_score }}">
                        </div>

                        <div class="form-group">

                          <label for="girls_winner">Did The Girls Win?</label>

                          <select name="girls_winner" id="girls_winner" class="form-control">
                            <option value="">Select An Option</option>
                            <option value="{{ $tennis->away_team_id }}" @if ($tennis->girls_winner === $tennis->away_team_id) selected @endif>
                               {{ $tennis->away_team->school_name }}
                            </option>
                            <option value="{{ $tennis->home_team_id }}" @if ($tennis->girls_winner === $tennis->home_team_id) selected @endif>
                              {{ $tennis->home_team->school_name }}
                            </option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="girls_match_score">What Was The Match Score?</label>
                          <input type="text" class="form-control" id="girls_match_score" name="girls_match_score" value="{{ $tennis->girls_match_score }}">
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Match</button>
                        </div>
                    
                    </form>

                    <form method="POST" action="/tennis/{{ $tennis->id }}">

                      {{ method_field('DELETE') }}

                      {{ csrf_field() }}    

                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-left">Delete Match</button>
                    
                    </form>

                    <script>
                      $(".delete").on("submit", function(){
                          return confirm("Do you want to delete this item?");
                      });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
