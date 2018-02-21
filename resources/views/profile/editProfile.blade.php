@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
      <li><a href="#">Edit Profile</a></li>
    </ol>
    <div class="row">
        @include('profile.sidebar')

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ucwords(Auth::user()->name)}}</div>

                <div class="panel-body">
                    <div class="col-sm-6 col-md-12">
                       <div class="thumbnail">
                         <h3 align="center">{{ucwords(Auth::user()->name)}}</h3>
                         <img src="../img/{{Auth::user()->picture}}" style="border-radius: 50%; height:120px; width:120px;"/><br><br>
                         <div class="caption">
                           <p align="center"></p>
                           <p align="center"><a href="{{url('/changePhoto')}}" class="btn btn-primary" role="button">Change Image</a>
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
