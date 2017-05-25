<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Years <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/years">View All</a></li>
                            <li><a href="/years/create">Create</a></li>
                          </ul>
                        </li>
                        @if (Auth::user())
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Game Times <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/times">View All</a></li>
                            <li><a href="/times/create">Create</a></li>
                          </ul>
                        </li>
                        @endif
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Teams <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/teams">View All</a></li>
                            <li><a href="/teams/create">Create</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Current Year <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/current-year">View Year</a></li>
                            <li><a href="/current-year/edit">Edit</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sports <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/baseball">Baseball</a></li>
                            <li><a href="/basketball-boys">Basketball (boys)</a></li>
                            <li><a href="/basketball-girls">Basketball (girls)</a></li>
                            <li><a href="/bowling-boys">Bowling (boys)</a></li>
                            <li><a href="/bowling-girls">Bowling (girls)</a></li>
                            <li><a href="/cross-country">Cross Country</a></li>
                            <li><a href="/football">Football</a></li>
                            <li><a href="/golf-boys">Golf (boys)</a></li>
                            <li><a href="/golf-girls">Golf (girls)</a></li>
                            <li><a href="/soccer-boys">Soccer (boys)</a></li>
                            <li><a href="/soccer-girls">Soccer (girls)</a></li>
                            <li><a href="/softball">Softball</a></li>
                            <li><a href="/swimming">Swimming</a></li>
                            <li><a href="/tennis-boys">Tennis (boys)</a></li>
                            <li><a href="/tennis-girls">Tennis (girls)</a></li>
                            <li><a href="/track">Track</a></li>
                            <li><a href="/volleyball">Volleyball</a></li>
                            <li><a href="/wrestling">Wrestling</a></li>
                          </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @include('layouts.errors')

        @include('layouts.success')

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <script>

        $(document).ready(function(){
            //var counter = $('#TextBox').val();
            $('#AddButton').click( function() {
                var counter = $('#home_team_final_score').val();
                counter++ ;
                $('#home_team_final_score').val(counter);
            });
            $('#SubtractButton').click( function() {
                var counter = $('#home_team_final_score').val();
                counter-- ;
                $('#home_team_final_score').val(counter);
            });
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(700, 0).slideUp(200, function(){
                $(this).remove(); 
            });
        }, 1000);

        jQuery( function() {
            jQuery( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        } );
    </script>

</body>
</html>
