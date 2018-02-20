@extends('profile.master')

@section('content')
<div class="container" id="app">
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
    </ol>
    <div class="row">
        @include('profile.sidebar')

        <div class="col-md-9">

            <div>
                <h1>@{{msg}} <small style="color:green">@{{content}}</small></h1>
                <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addPost"><br>
                  <textarea class="form-control" v-model="content"></textarea><br>
                    <button type="submit" class="btn btn-success">Submit</button><br><br>
                </form>
            </div>

            <div class="panel panel-default">
                <div v-for="post in posts">
                    <div class="col-md-12" style="background-color:#fff">
                        <div class="col-md-2 pull-left">
                            {{-- <img src="../img/" style="width:100px; margin:10px"> --}}
                        </div>
                        <div class="col-md-10">
                            <h3>@{{post.name}}</h3>
                            <p><i class="fa fa-globe"></i> @{{post.city}} - @{{post.country}}</p>
                            <small><b>Gender: </b>@{{post.gender}}</small><br>
                            <small>@{{post.created_at}}</small>
                        </div>
                        <p class="col-md-12" style="color:#333">@{{post.content}}</p>
                    </div><br><hr>
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection
