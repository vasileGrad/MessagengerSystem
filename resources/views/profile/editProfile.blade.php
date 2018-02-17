@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
      <li><a href="#">Edit Profile</a></li>
    </ol>
    <div class="row">
        @include('profile.sidebar');

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ucwords(Auth::user()->name)}}</div>

                <div class="panel-body">
                    <div class="col-sm-6 col-md-12">
                       <div class="thumbnail">
                         <img src="../img/{{Auth::user()->picture}}"  height="100px" width="100px"/><br><br>
                         <div class="caption">
                           <h3>{{ucwords(Auth::user()->name)}}</h3>
                           <p align="center"></p>
                           <p align="center"><a href="{{url('/editProfile')}}" class="btn btn-primary" role="button">Edit Profile</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                    </div>
                </div>


        <div class="col-sm-6 col-md-4">
            <span class="label label-default">Update Profile</span>
            <br>
        </div>
    </div>
</div>

@endsection
