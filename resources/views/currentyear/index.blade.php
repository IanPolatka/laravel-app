@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Current School Year</div>
                <ul class="list-group">
               	    <li class="list-group-item">{{ $currentyear->year }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
