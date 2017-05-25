@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                  Game Summary
                    <div class="pull-right"><small><strong>
                      @if ($volleyball->game_status == "0") {{ $volleyball->game_time }} @endif
                      @if ($volleyball->game_status == "1") <span style="color: red">1st Game</span> @endif
                      @if ($volleyball->game_status == "2") <span style="color: red">2nd Game</span> @endif
                      @if ($volleyball->game_status == "3") <span style="color: red">3rd Game</span> @endif
                      @if ($volleyball->game_status == "4") <span style="color: red">4th Quarter</span> @endif
                      @if ($volleyball->game_status == "5") <span style="color: red">5th Quarter</span> @endif
                      @if ($volleyball->game_status == "6") Final @endif
                    </strong></small></div>
                </div>

                    <ul class="list-group">

                      <li class="list-group-item">

                        @if ($volleyball->tournament_title)
                          <small><strong>{{ $volleyball->tournament_title }}</strong></small>
                        @endif

                        <div class="clearfix"></div>

                      </li>

                      <li class="list-group-item">
                        @if ($volleyball->away_team->logo)
                          <img src="/images/team-logos/{{ $volleyball->away_team->logo }}" 
                            style="height: 20px; width: 20px; float: left; margin-right: 10px;">
                        @endif
                        {{ $volleyball->away_team->school_name }}
                        @if ($volleyball->possession === $volleyball->away_team_id)
                          <span class="glyphicon glyphicon-bell" aria-hidden="true" style="margin-right: 10px"></span>
                        @endif
                        <span class="pull-right" style="width: 25px">{{ $volleyball->away_team_fifth_game_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $volleyball->away_team_fourth_game_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $volleyball->away_team_third_game_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $volleyball->away_team_second_game_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $volleyball->away_team_first_game_score }}</span>
                      </li>
                      <li class="list-group-item">
                        @if ($volleyball->home_team->logo)
                          <img src="/images/team-logos/{{ $volleyball->home_team->logo }}" 
                            style="height: 20px; width: 20px; float: left; margin-right: 10px;">
                        @endif
                        {{ $volleyball->home_team->school_name }}
                        <span class="pull-right" style="width: 25px">{{ $volleyball->home_team_fifth_game_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $volleyball->home_team_fourth_game_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $volleyball->home_team_third_game_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $volleyball->home_team_second_game_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $volleyball->home_team_first_game_score }}</span>
                      </li>

                    </ul>

            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Update Game</div>

                <div class="panel-body">
                    <form method="POST" action="/volleyball/game/{{ $volleyball->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

                        <div class="form-group">

                          <label for="year_id">What Year Is This Match For?</label>

                          <select name="year_id" id="year_id" class="form-control">

                            <option value="">Select A School Year</option>

                            <option value="{{ $thecurrentyear['id'] }}">{{ $thecurrentyear['year'] }}</option>

                            <option value="">---------------------</option>

                            @foreach($years as $year)

                              <option value="{{ $year->id }}" @if ($volleyball->year_id === $year->id) selected @endif >
                                  {{ $year->year }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="team_level">What Team Level Is This For?</label>
                          <select name="team_level" id="team_level" class="form-control">
                              <option value="1" @if ($volleyball->team_level === "1") selected @endif>Varsity</option>
                              <option value="2" @if ($volleyball->team_level === "2") selected @endif>Junior Varsity</option>
                              <option value="3" @if ($volleyball->team_level === "3") selected @endif>Freshman</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="text" class="form-control" id="datepicker" name="date" value="{{ $volleyball->date }}" required>
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($volleyball->scrimmage == "0") selected @endif>No</option>
                              <option value="1" @if ($volleyball->scrimmage == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $volleyball->tournament_title }}">
                        </div>

                        <div class="form-group">

                          <label for="away_team_id">Away Team</label>

                          <select name="away_team_id" id="away_team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($volleyball->away_team_id == $team['id']) selected @endif>
                                {{ $team['school_name'] }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_id">Home Team</label>

                          <select name="home_team_id" id="home_team_id" class="form-control">

                            <option value="null">Please Select An Home School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($volleyball->home_team_id === $team['id']) selected @endif>{{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  --> 
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($volleyball->time_id === $time->id) selected @endif>{{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="district_game">Is This A District Game?</label>

                          <select name="district_game" id="district_game" class="form-control">
                              <option value="0" @if ($volleyball->district_game == "0") selected @endif>No</option>
                              <option value="1" @if ($volleyball->district_game == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->



                        <h4><strong>Game Score</strong></h4>

                        <div class="form-group">

                          <label for="away_team_first_game_score">{{ $volleyball->away_team->school_name }} {{ $volleyball->away_team->mascot }} First Game Score</label>

                          <select name="away_team_first_game_score" id="away_team_first_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_first_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_second_game_score">{{ $volleyball->away_team->school_name }} {{ $volleyball->away_team->mascot }} Second Game Score</label>

                          <select name="away_team_second_game_score" id="away_team_second_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_second_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_third_game_score">{{ $volleyball->away_team->school_name }} {{ $volleyball->away_team->mascot }} Third Game Score</label>

                          <select name="away_team_third_game_score" id="away_team_third_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_third_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_fourth_game_score">{{ $volleyball->away_team->school_name }} {{ $volleyball->away_team->mascot }} Fourth Game Score</label>

                          <select name="away_team_fourth_game_score" id="away_team_fourth_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_fourth_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_fifth_game_score">{{ $volleyball->away_team->school_name }} {{ $volleyball->away_team->mascot }} Fifth Game Score</label>

                          <select name="away_team_fifth_game_score" id="away_team_fifth_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_fifth_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <hr>

                        <div class="form-group">

                          <label for="away_team_first_game_score">{{ $volleyball->home_team->school_name }} {{ $volleyball->home_team->mascot }} First Game Score</label>

                          <select name="home_team_first_game_score" id="home_team_first_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_first_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_second_game_score">{{ $volleyball->home_team->school_name }} {{ $volleyball->home_team->mascot }} Second Game Score</label>

                          <select name="home_team_second_game_score" id="home_team_second_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_second_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_third_game_score">{{ $volleyball->home_team->school_name }} {{ $volleyball->home_team->mascot }} Third Game Score</label>

                          <select name="home_team_third_game_score" id="home_team_third_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_third_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_fourth_game_score">{{ $volleyball->home_team->school_name }} {{ $volleyball->home_team->mascot }} Fourth Game Score</label>

                          <select name="home_team_fourth_game_score" id="home_team_fourth_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_fourth_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_fifth_game_score">{{ $volleyball->home_team->school_name }} {{ $volleyball->home_team->mascot }} Fifth Game Score</label>

                          <select name="home_team_fifth_game_score" id="home_team_fifth_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_fifth_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->


                        <div class="clearfix"></div>



                        

                        <hr>



                        <div class="form-group">

                          <label for="game_status">Game Status</label>

                          <select name="game_status" id="game_status" class="form-control">

                            <option value="" @if ($volleyball->game_status == "") selected @endif>Select A Status</option>
                            <option value="0" @if ($volleyball->game_status == "0") selected @endif>Game Has Not Started Yet</option>
                            <option value="1" @if ($volleyball->game_status == "1") selected @endif>1st Game</option>
                            <option value="2" @if ($volleyball->game_status == "2") selected @endif>2nd Game</option>
                            <option value="3" @if ($volleyball->game_status == "3") selected @endif>3rd Game</option>
                            <option value="4" @if ($volleyball->game_status == "4") selected @endif>4th Game</option>
                            <option value="5" @if ($volleyball->game_status == "5") selected @endif>5th Game</option>
                            <option value="6" @if ($volleyball->game_status == "6") selected @endif>Final</option>

                          </select>

                        </div><!--  Form  Group  -->





                        <hr>





                        <div class="form-group">

                          <label for="winning_team">Winning Team</label>

                          <select name="winning_team" id="winning_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $volleyball->away_team->id }}" @if ($volleyball->winning_team === $volleyball->away_team_id) selected @endif>
                              {{ $volleyball->away_team->school_name }}
                            </option>
                            <option value="{{ $volleyball->home_team->id }}" @if ($volleyball->winning_team === $volleyball->home_team_id) selected @endif>
                              {{ $volleyball->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="losing_team">Losing Team</label>

                          <select name="losing_team" id="losing_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $volleyball->away_team->id }}" @if ($volleyball->losing_team === $volleyball->away_team_id) selected @endif>
                              {{ $volleyball->away_team->school_name }}
                            </option>
                            <option value="{{ $volleyball->home_team->id }}" @if ($volleyball->losing_team === $volleyball->home_team_id) selected @endif>
                              {{ $volleyball->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->



                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Game</button>
                        </div>
                    
                    </form>

                    <form method="POST" action="/volleyball/{{ $volleyball->id }}">

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
