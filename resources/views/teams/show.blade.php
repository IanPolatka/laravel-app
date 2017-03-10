@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">The Compiled List</div>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="/teams/{{ $team->id }}/edit">{{ $team->school_name }} <span class="pull-right">{{ $team->mascot }}</span></a></li>
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
