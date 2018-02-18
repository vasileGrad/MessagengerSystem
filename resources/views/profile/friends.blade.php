@extends('profile.master')

@section('content')

<div class="container">

    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}">Home</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
        <li><a href="">Find Friends</a></li>
    </ol>


    <div class="row">
        @include('profile.sidebar')


        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ucwords(Auth::user()->name)}}'s Friends</div>

                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                        @if ( session()->has('msg') )
                            <p class="alert alert-success">{{ session()->get('msg')}}</p>
                        @endif
                        @foreach($friends as $uList)
                            <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                <div class="col-md-2 pull-left">
                                    <a href=""><img src="../img/{{$uList->picture}}" style="height:80px; width:80px" class="img-rounded"/><br><br>
                                    </a>
                                </div>

                                <div class="col-md-7 pull-left">
                                    <h3 style="margin:0px"><a href="{{url('/profile')}}/{{$uList->slug}}">
                                      {{ucwords($uList->name)}}</a></h3>
                                    
                                    <p><b>Gender:</b> {{$uList->gender}}</p>

                                </div>

                                <div class="col-md-3 pull-right">
                                    {{-- @if ( session()->has('msg') )
                                        <p>{{ session()->get('msg')}}</p>
                                    @else --}}
                                        <p>
                                            <a href="{{url('/unfriend')}}/{{$uList->id}}" class="btn btn-default btn-sm">UnFriend</a></p>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                            
                            