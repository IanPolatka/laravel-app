@extends('layouts.app')

@section('content')



<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                Volleyball

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-md-6 col-xs-6">

                    <div class="form-group">

                        <select name="home_team_id" id="home_team_id" class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Team's Schedule</option>

                            @foreach($teams as $team)

                                <option value="/volleyball/{{$showcurrentyear[0]}}/{{ $team->school_name }}">
                                    {{ $team->school_name }} ({{ $team->city }}, {{ $team->state }})
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-md-6 col-xs-6">

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                              <option value="/volleyball/{{ $year->year }}" @if ($showcurrentyear[0] == $year->year) selected @endif>
                                {{ $year->year }}
                              </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                

            </div>
    

           <div class="content-box">

                    <h4>Today's Games <small>({{ Carbon\Carbon::parse($date[0])->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">

                        @if (Auth::user())

                            <a href="/volleyball/create" class="create-game">
                                <li>
                                    <img src="/images/team-logos/create-game.png">Create Match
                                </li>
                                <div class="clearfix"></div>
                            </a>

                        @endif

                        @forelse ($volleyball as $item)

                            <li><a href="volleyball/match/{{ $item->id }}">

                                <div class="team">
                                
                                    @if ( $item['away_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item['away_team']['logo'] }}">
                                    @endif

                                    {{ $item['away_team']['school_name'] }}

                                </div>

                                <div class="team">

                                    @if ( $item['home_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item->home_team->logo }}"> 
                                    @endif

                                    {{ $item['home_team']['school_name'] }}

                                </div>

                            </a></li>

                        @empty

                            <li>No Matches Posted</li>

                        @endforelse

                    </ul>

            </div>

            <div class="content-box">

                    <h4>Yesterday's Matches <small>({{ Carbon\Carbon::parse($yesterday)->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">

                        @forelse ($countYesterday as $item)

                            <li><a href="volleyball/match/{{ $item->id }}">

                                <div class="team">
                                
                                    @if ( $item['away_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item->away_team->logo }}">
                                    @endif

                                    {{ $item['away_team']['school_name'] }}

                                    @if ($item['game_status'] < 1)

                                        <strong class="pull-right game-list-status">{{ $item['time']['time'] }}</strong>

                                    @elseif (($item['game_status'] > 0) && ($item['game_status'] < 7))

                                        <strong class="pull-right game-list-status">
                                            <span style="color: red;">LIVE</span>
                                        </strong>

                                    @endif

                                    @if ($item['winning_team'] == $item['away_team_id'])</strong>@endif

                                </div><!--  Team  -->

                                

                        @empty

                            <li>No Games Posted</li>

                        @endforelse

                    </ul>


            </div>



            <div class="content-box">

                    <h4>Tomorrows's Games <small>({{ Carbon\Carbon::parse($tomorrow)->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">


                    </ul>


            </div>

        </div>

    </div>
</div>

<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="row">

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id" id="home_team_id" class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Team's Schedule</option>

                            @foreach($teams as $team)

                              <option value="/volleyball/{{$showcurrentyear[0]}}/{{ $team->school_name }}">{{ $team->school_name }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                              <option value="/volleyball/{{ $year->year }}" @if ($showcurrentyear[0] == $year->year) selected @endif>
                                {{ $year->year }}
                              </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                @if (Auth::user())

                    <div class="col-lg-2">

                        <p><a class="pull-right btn btn-success" href="/volleyball/create">Create Match</a></p>

                        <div class="clearfix"></div>

                    </div>

                @endif

            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">Volleyball Schedule</div>
                    <ul class="list-group">
                        @forelse ($volleyball as $item)

                            <li class="list-group-item">
                                {{ Carbon\Carbon::parse($item->date)->format('l') }} {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}<br />
                                @if ( $item->away_team->logo )
                                    <img src="/images/team-logos/{{ $item->away_team->logo }}" style="height: 20px; width: 20px; border-radius: 3px;margin-right: 5px;">
                                @endif
                                <a href="/volleyball/{{ $showcurrentyear[0] }}/{{ $item->away_team->school_name }}">{{ $item->away_team->school_name }}</a> vs
                                @if ( $item->home_team->logo )
                                    <img src="/images/team-logos/{{ $item->home_team->logo }}" style="height: 20px; width: 20px; border-radius: 3px;margin: 0px 5px;"> 
                                @endif
                                <a href="/volleyball/{{ $showcurrentyear[0] }}/{{ $item->home_team->school_name }}">{{ $item->home_team->school_name }}</a>
                                @if ($item->tournament_title)
                                    <small>({{ $item->tournament_title }})</small>
                                @endif
                                @if (Auth::user())
                                    <span class="pull-right"><a href="/volleyball/game/{{ $item->id }}/edit">Edit</a></span>&nbsp;&nbsp;&nbsp;
                                @endif
                            </li>

                        @empty

                            <li class="list-group-item">No Games Posted</li>

                        @endforelse

                    </ul>
            </div>

        </div>

    </div>
</div> -->
@endsection
