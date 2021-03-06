@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Game ID: {{ $baseball['id'] }}</div>
                    <ul class="list-group">
                        <li class="list-group-item">{{ $baseball->away_team->school_name }} vs {{ $baseball->home_team->school_name }}</li>
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
