<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}

    <style>
        /* Scrollbar styles for Messenger*/
        #myScroll::-webkit-scrollbar {
            width: 15px;
            height: 15px;
        }
        #myScroll::-webkit-scrollbar-track {
            border: 1px solid #a4a4a5;
            border-radius: 2px;
        }
        #myScroll::-webkit-scrollbar-thumb {
            background: gray;  
            border-radius: 10px;
            margin-top: 20px;
        }
        #myScroll::-webkit-scrollbar-thumb:hover {
            background: #b1b2b5; 
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{url('/')}}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Route::has('login'))
                            <li><a href="{{ url('/findFriends')}}">Find Friends</a></li>
                            <li><a href="{{ url('/requests')}}">My Requests <span class="badge"> {{-- {{App\Friendship::where('status', 0)->where('user_requested', Auth::user()->id)->count()}} --}} </span></a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="{{ url('messages') }}">Messages</a></li>

                            <li style="height:10px">
                                <a href="">
                                    <img src="/img/{{Auth::user()->picture}}" style="border-radius: 50%" height="40px" width="40px"/><br><br>
                                </a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ ucwords(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/profile/') }}/{{Auth::user()->slug}}">Profile</a></li>
                                    <li><a href="{{ url('editProfile') }}">Edit Profile</a></li>

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

                            <li>
                                <a href="{{ url('/friends')}}"><span><i class="glyphicon glyphicon-user" aria-hidden="true" style="font-size:30px; position:absolute; right:-2px; margin-top:8px"></i><i class="glyphicon glyphicon-user" aria-hidden="true" style="font-size:30px;"></i></span></a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="glyphicon glyphicon-globe" aria-hidden="true" style="font-size:30px;"></i>
                                    <span class="badge" style="background:red; position: relative; top: -20px; left:-10px">
                                        {{App\Notification::where('status', 1)  ->where('user_hero', Auth::user()->id)->count()}}
                                    </span>
                                </a>

                                <?php 
                                $notes = DB::table('users') 
                                        ->leftJoin('notifications', 'users.id', 'notifications.user_logged') 
                                        ->where('user_hero', Auth::user()->id)
                                        ->where('status', 1)  // unread notification
                                        ->orderBy('notifications.created_at', 'desc')
                                        ->get();
                                //dd($notes);
                                ?>

                                <ul class="dropdown-menu" role="menu">
                                    @foreach($notes as $note)
                                        <a href="{{url('/notifications')}}/{{$note->id}}">
                                        @if($note->status == 1)
                                            <li style="background-color:#E4E9F2; padding:10px">
                                        @else
                                            <li style="padding:10px">
                                        @endif
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="/img/{{$note->picture}}" style="width:50px; padding:5px; background:#fff; border:1px solid #eee" class="img-rounded">
                                                </div>
                                                <div class="col-md-10">
                                                    <b style="color:green; font-size:90%">{{ucwords($note->name)}}</b> <span style="color:#000; font-size:90%">{{$note->note}}</span><br>
                                                    <small style="color:#90949C">
                                                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                        {{ date('F j, Y', strtotime($note->created_at))}} at {{ date('H: i', strtotime($note->created_at))}}</small>
                                                </div>
                                            </div>
                                          </li>
                                        </a>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>



        {{-- <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
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
                        @if (Route::has('login'))
                            <li><a href="{{ url('/profile')}}">Profile</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="">
                                    <img src="../img/{{Auth::user()->picture}}" style="border-radius: 50%" height="40px" width="40px"/><br><br>
                                </a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ ucwords(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/profile.js') }}"></script>
</body>
</html>
