@extends('layouts.app')



<?php

  if (isset($football->away_team_first_qrt_score)) :
    $awayFirst = $football->away_team_first_qrt_score;
  else:
    $awayFirst = 0;
  endif;
  if (isset($football->away_team_second_qrt_score)) :
    $awaySecond = $football->away_team_second_qrt_score;
  else:
    $awaySecond = 0;
  endif;
  if (isset($football->away_team_third_qrt_score)) :
    $awayThird = $football->away_team_third_qrt_score;
  else:
    $awayThird = 0;
  endif;
  if (isset($football->away_team_fourth_qrt_score)) :
    $awayFourth = $football->away_team_fourth_qrt_score;
  else:
    $awayFourth = 0;
  endif;
  if (isset($football->away_team_overtime_score)) :
    $awayOver = $football->away_team_overtime_score;
  else:
    $awayOver = 0;
  endif;

  if (isset($football->home_team_first_qrt_score)) :
    $homeFirst = $football->home_team_first_qrt_score;
  else:
    $homeFirst = 0;
  endif;
  if (isset($football->home_team_second_qrt_score)) :
    $homeSecond = $football->home_team_second_qrt_score;
  else:
    $homeSecond = 0;
  endif;
  if (isset($football->home_team_third_qrt_score)) :
    $homeThird = $football->home_team_third_qrt_score;
  else:
    $homeThird = 0;
  endif;
  if (isset($football->home_team_fourth_qrt_score)) :
    $homeFourth = $football->home_team_fourth_qrt_score;
  else:
    $homeFourth = 0;
  endif;
  if (isset($football->home_team_overtime_score)) :
    $homeOver = $football->home_team_overtime_score;
  else:
    $homeOver = 0;
  endif;

  $awayActiveScore = $awayFirst + $awaySecond + $awayThird + $awayFourth + $awayOver;
  $homeActiveScore = $homeFirst + $homeSecond + $homeThird + $homeFourth + $homeOver;

?>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Game Summary</div>

                    <ul class="list-group">

                      <li class="list-group-item">
                        {{ $football->away_team->school_name }}
                        @if ($football->away_team_final_score)
                          <span class="pull-right">{{$football->away_team_final_score}}&nbsp;</span>
                        @else
                          <span class="pull-right"><?php echo $awayActiveScore; ?>&nbsp;</span>
                        @endif
                        <span class="pull-right">{{ $football->away_team_overtime_score }}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="pull-right">{{ $football->away_team_fourth_qrt_score }}</span>
                        <span class="pull-right">{{ $football->away_team_third_qrt_score }}</span>
                        <span class="pull-right">{{ $football->away_team_second_qrt_score }}</span>
                      </li>
                      <li class="list-group-item">
                        {{ $football->home_team->school_name }}
                        @if ($football->home_team_final_score)
                          <span class="pull-right">{{$football->home_team_final_score}}&nbsp;</span>
                        @else
                          <span class="pull-right"><?php echo $homeActiveScore; ?>&nbsp;</span>
                        @endif
                        <span class="pull-right">{{ $football->home_team_overtime_score }}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="pull-right">{{ $football->home_team_fourth_qrt_score }}</span>
                        <span class="pull-right">{{ $football->home_team_third_qrt_score }}</span>
                        <span class="pull-right">{{ $football->home_team_second_qrt_score }}</span>
                      </li>

                    </ul>

            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Update Game</div>

                <div class="panel-body">
                    <form method="POST" action="/football/game/{{ $football->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

                        <div class="form-group">

                          <label for="year_id">What Year Is This Match For?</label>

                          <select name="year_id" id="year_id" class="form-control">

                            <option value="">Select A School Year</option>

                            <option value="{{ $thecurrentyear['id'] }}">{{ $thecurrentyear['year'] }}</option>

                            <option value="">---------------------</option>

                            @foreach($years as $year)

                              <option value="{{ $year->id }}" @if ($football->year_id === $year->id) selected @endif >
                                  {{ $year->year }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="text" class="form-control" id="datepicker" name="date" value="{{ $football->date }}" required>
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($football->scrimmage == "0") selected @endif>No</option>
                              <option value="1" @if ($football->scrimmage == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $football->tournament_title }}">
                        </div>

                        <div class="form-group">

                          <label for="away_team_id">Away Team</label>

                          <select name="away_team_id" id="away_team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team->id }}" @if ($football->away_team_id === $team->id) selected @endif>
                                {{ $team->school_name }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_id">Home Team</label>

                          <select name="home_team_id" id="home_team_id" class="form-control">

                            <option value="null">Please Select An Home School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team->id }}" @if ($football->home_team_id === $team->id) selected @endif>{{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  --> 
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($football->time_id === $time->id) selected @endif>{{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="district_game">Is This A District Game?</label>

                          <select name="district_game" id="district_game" class="form-control">
                              <option value="0" @if ($football->district_game == "0") selected @endif>No</option>
                              <option value="1" @if ($football->district_game == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->



                        <h4><strong>Game Score</strong></h4>

                        <div class="form-group">

                          <label for="away_team_first_qrt_score">{{ $football->away_team->school_name }} {{ $football->away_team->mascot }} First Quarter Score</label>

                          <select name="away_team_first_qrt_score" id="away_team_first_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_first_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_second_qrt_score">{{ $football->away_team->school_name }} {{ $football->away_team->mascot }} Second Quarter Score</label>

                          <select name="away_team_second_qrt_score" id="away_team_second_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_second_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_third_qrt_score">{{ $football->away_team->school_name }} {{ $football->away_team->mascot }} Third Quarter Score</label>

                          <select name="away_team_third_qrt_score" id="away_team_third_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_third_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_fourth_qrt_score">{{ $football->away_team->school_name }} {{ $football->away_team->mascot }} Fourth Quarter Score</label>

                          <select name="away_team_fourth_qrt_score" id="away_team_fourth_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_fourth_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_overtime_score">{{ $football->away_team->school_name }} {{ $football->away_team->mascot }} Overtime Score</label>

                          <select name="away_team_overtime_score" id="away_team_overtime_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_overtime_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_final_score">{{ $football->away_team->school_name }} {{ $football->away_team->mascot }} Final Score</label>

                          <select name="away_team_final_score" id="away_team_final_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 199; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_final_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <hr>

                        <div class="form-group">

                          <label for="away_team_first_qrt_score">{{ $football->home_team->school_name }} {{ $football->home_team->mascot }} First Quarter Score</label>

                          <select name="home_team_first_qrt_score" id="home_team_first_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_first_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_second_qrt_score">{{ $football->home_team->school_name }} {{ $football->home_team->mascot }} Second Quarter Score</label>

                          <select name="home_team_second_qrt_score" id="home_team_second_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_second_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_third_qrt_score">{{ $football->home_team->school_name }} {{ $football->home_team->mascot }} Third Quarter Score</label>

                          <select name="home_team_third_qrt_score" id="home_team_third_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_third_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_fourth_qrt_score">{{ $football->home_team->school_name }} {{ $football->home_team->mascot }} Fourth Quarter Score</label>

                          <select name="home_team_fourth_qrt_score" id="home_team_fourth_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_fourth_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_overtime_score">{{ $football->home_team->school_name }} {{ $football->home_team->mascot }} Overtime Score</label>

                          <select name="home_team_overtime_score" id="home_team_overtime_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_overtime_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_final_score">{{ $football->home_team->school_name }} {{ $football->home_team->mascot }} Final Score</label>

                          <select name="home_team_final_score" id="home_team_final_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 199; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_final_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <hr>

                        <div class="form-group">

                          <label for="winning_team">Winning Team</label>

                          <select name="winning_team" id="winning_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $football->away_team->id }}" @if ($football->winning_team === $football->away_team_id) selected @endif>
                              {{ $football->away_team->school_name }}
                            </option>
                            <option value="{{ $football->home_team->id }}" @if ($football->winning_team === $football->home_team_id) selected @endif>
                              {{ $football->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="losing_team">Losing Team</label>

                          <select name="losing_team" id="losing_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $football->away_team->id }}" @if ($football->losing_team === $football->away_team_id) selected @endif>
                              {{ $football->away_team->school_name }}
                            </option>
                            <option value="{{ $football->home_team->id }}" @if ($football->losing_team === $football->home_team_id) selected @endif>
                              {{ $football->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->


                        <div class="form-group">

                          <label for="game_status">Game Status</label>

                          <select name="game_status" id="game_status" class="form-control">

                            <option value="">Select A Status</option>
                            <option value="0">Game Has Not Started Yet</option>
                            <option value="1">1st Quarter</option>
                            <option value="2">2nd Quarter</option>
                            <option value="3">Halftime</option>
                            <option value="4">3rd Quarter</option>
                            <option value="5">4th Quarter</option>
                            <option value="6">Overtime</option>
                            <option value="7">Final</option>

                          </select>

                        </div><!--  Form  Group  -->



                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Game</button>
                        </div>
                    
                    </form>

                    <form method="POST" action="/football/{{ $football->id }}">

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
