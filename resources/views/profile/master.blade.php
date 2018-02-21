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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles for Home page-->
    <style>
        .head_har{
          background-color: #f6f7f9;
          border-bottom: 1px solid #dddfe2;
          border-radius: 2px 2px 0 0;
          font-weight: bold;
          padding: 8px 6px;
        }
        .left-sidebar, .right-sidebar{
          background-color:#fff;
          height:600px;
        }
        .posts_div{margin-bottom:10px !important;}
        .posts_div h3{
          margin-top:4px !important;
        }
        #postText{
          border:none;
          height:100px
        }
        .likeBtn{
          color: #4b4f56; font-weight:bold; cursor: pointer;
        }
        .left-sidebar li { padding:10px;
          border-bottom:1px solid #ddd;
        list-style:none; margin-left:-20px}
        .dropdown-menu{min-width:120px; left:-30px}
        .dropdown-menu a{ cursor: pointer;}
        .dropdown-divider {
          height: 1px;
          margin: .5rem 0;
          overflow: hidden;
          background-color: #eceeef;}
          .user_name{font-size:18px;
           font-weight:bold; text-transform:capitalize; margin:3px}
          .all_posts{background-color:#fff; padding:5px;
           margin-bottom:15px; border-radius:5px;
            -webkit-box-shadow: 0 8px 6px -6px #666;
            -moz-box-shadow: 0 8px 6px -6px #666;
             box-shadow: 0 8px 6px -6px #666;}
            #commentBox{
              background-color:#ddd;
              padding:10px;
              width:99%; margin:0 auto;
              background-color:#F6F7F9;
              padding:10px;
              margin-bottom:10px
            }
            #commentBox li { list-style:none; padding:10px; border-bottom:1px solid #ddd}
            .commet_form{ padding:10px; margin-bottom:10px}
            .commentHand{color:blue}
            .commentHand:hover{cursor:pointer}
            .upload_wrap{
              position:relative;
              display:inline-block;
              width:100%
            }
            .center-con{
              max-height:600px;
              position: relative;
              verflow-y: scroll;
              /*left:calc(10%);
              verflow-y: scroll;*/
            }
            @media (min-width: 268px) and (max-width: 768px) {
              .center-con{
                max-height:600px;
                position: relative;
                left:0px;
                overflow-y: scroll;
              }
            }
        </style>
    </style>
</head>
<body>
    <div {{-- id="app" --}}>
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
                            <li><a href="{{ url('/requests')}}">My Requests <span class="badge"> {{App\Friendship::where('status', 0)->where('user_requested', Auth::user()->id)->count()}} </span></a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="">
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
                                <a href="{{ url('/friends')}}"><i class="fa fa-users fa-2x" aria-hidden="true"></i></a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
                                    <span class="badge" style="background:red; position: relative; top: -10px; left:-10px">
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

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
