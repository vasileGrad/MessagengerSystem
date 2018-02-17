@extends('profile.master')

@section('content')
<div class="container">
    <div class="row">
        @include('profile.sidebar');

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ucwords(Auth::user()->name)}}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Welcome to your profile</h2><br>

                    <img src="../img/{{Auth::user()->picture}}"  height="100" width="100"/><br><hr>

                    <form action="uploadPhoto" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="file" name="picture" class="form-control"/><br>
                        <input type="submit" name="btn" class="btn btn-success"/>
                    </form>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
