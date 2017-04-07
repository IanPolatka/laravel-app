@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="row">

                <div class="col-lg-12">

                    <p><a class="pull-right btn btn-success" href="/tennis/create">Create Match</a></p>

                    <div class="clearfix"></div>

                </div>

            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">Tennis Schedule</div>
                    <ul class="list-group">
                        @foreach($tennis as $item)

                            <li class="list-group-item">
                                {{ $item->date }} |
                                <a href="/tennis/team/{{ $item->away_team_id }}">
                                    
                                    {{ $item->away_team->school_name }}</a> 
                                    
                                <a href="/tennis/team/{{ $item->home_team_id }}">{{ $item->home_team->school_name }}</a>
                                @if ($item->tournament_title)
                                    <small>({{ $item->tournament_title }})</small>
                                @endif
                                <span class="pull-right"><a href="/tennis/{{ $item->id }}/edit">Edit</a></span>&nbsp;&nbsp;&nbsp;
                            </li>

                        @endforeach
                    </ul>
            </div>

        </div>
    </div>
</div>
@endsection
