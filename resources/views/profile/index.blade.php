@extends('profile.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ucwords(Auth::user()->name)}}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Welcome to your profile</h2><br>

                    <img src="../img/{{Auth::user()->picture}}"  height="100px" width="100px"/><br><br>
                    {{-- <img src="{{URL::asset('img/man.jpeg')}}" width="80px" height="80px"><br><br> --}}
                    <a href="/changePhoto">Change Image</a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
