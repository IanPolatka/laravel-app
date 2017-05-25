@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">The Compiled List</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            {{ Carbon\Carbon::parse($tennisboys->date)->format('l') }} {{ Carbon\Carbon::parse($tennisboys->date)->format('M j, o') }}<br />
                            <a href="/tennis-boys/{{ $tennisboys->id }}">
                                {{ $tennisboys->away_team->school_name }}
                            </a>
                            vs 
                            <a href="">
                                {{ $tennisboys->home_team->school_name }}
                            </a>
                            <span class="pull-right"><a href="/tennis-boys/{{ $tennisboys->id }}/edit">Edit</a></span>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
