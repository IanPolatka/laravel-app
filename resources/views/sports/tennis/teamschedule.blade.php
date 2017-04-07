@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ $team->school_name }} Tennis Schedule</div>
                    <ul class="list-group">
                        @forelse($tennis as $item)

                            <li class="list-group-item">
                                {{ $item['date'] }}  |
                                {{ $item['tournament-title'] }}
                                @if ($team->id === $item->home_team_id)
                                    <a href="/tennis/team/{{ $item['away_team_id'] }}">vs {{ $item['away_team']['school_name'] }}</a>
                                @else
                                    <a href="/tennis/team/{{ $item['home_team_id'] }}">@ {{ $item['home_team']['school_name'] }}</a>
                                @endif
                                <span class="pull-right"><a href="/tennis/{{ $item->id }}/edit">Edit</a></span>
                            </li>

                        @empty

                            <li class="list-group-item">No Matches Posted</li>

                        @endforelse
                    </ul>
            </div>

        </div>
    </div>
</div>
@endsection
