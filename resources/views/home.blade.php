@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
    </ol>
    <div class="row">
        @include('profile.sidebar');
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br><br><a href="profile">Profile</a>
                    <br><br><a href="messages2">Messages2</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
