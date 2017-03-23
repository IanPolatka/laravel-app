@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    
            <div class="panel panel-default">
                <div class="panel-heading">Today's Match</div>
                    <ul class="list-group">
                        @forelse($todaysmatch as $item)

                            <li class="list-group-item">
                                <a href="/tennis/{{ $item->id }}">
                                    {{ $item->date }}
                                    {{ $item->team->school_name }}
                                    {{ $item->team->mascot }}
                                    ({{ $item->team->city }},
                                    {{ $item->team->state }})
                                </a>
                            </li>

                        @empty

                            <li class="list-group-item">
                                No Tennis Matches Today
                            </li>

                        @endforelse
                    </ul>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">The Compiled List</div>
                    <ul class="list-group">
                        @foreach($tennis as $item)

                            <li class="list-group-item">
                                <a href="/tennis/{{ $item->id }}">
                                    {{ $item->date }}
                                    {{ $item->team->school_name }}
                                    {{ $item->team->mascot }}
                                    ({{ $item->team->city }},
                                    {{ $item->team->state }})
                                </a>
                            </li>

                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
