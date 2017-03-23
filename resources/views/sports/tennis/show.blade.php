@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">The Compiled List</div>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="/tennis/{{ $tennis->id }}/edit">{{ $tennis->team->city }} {{ $tennis->year->year }}</a></li>
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
