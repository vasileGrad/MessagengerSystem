@extends('profile.master')

@section('content')
{{-- <div class="container" > --}}
  {{--   <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
    </ol> --}}
    <div class="row">

        <div class="col-md-12" id="app">

            <div class="col-md-3 left-sidebar">
                <h3 align="center">Left Sidebar</h3>
                <hr>
            </div>

            <div class="col-md-6 center-con">
            @if(Auth::check())
                <div class="posts_div">
                    <div class="head_har" >
                        @{{msg}}
                    </div>
                    <div style="background-color:#fff">
                        <div class="row">
                            <div class="col-md-1 pull-left">
                                <img src="../img/{{Auth::user()->picture}}" style="width:60px; margin:10px" class="img-rounded">
                            </div>
                            <div class="col-md-10 pull-right">
                                <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addPost"><br>
                                    <textarea class="form-control" v-model="content" id="postText" placeholder="What's on your mind?"></textarea><br>
                                    <button type="submit" class="btn btn-info pull-right" style="margin:10px" id="postBtn">Post</button><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
                
                <div class="posts_div">
                    <div class="head_har" Posts>
                        <div v-for="post in posts">
                            <div class="col-md-12" style="background-color:#fff">
                                <div class="col-md-2 pull-left">
                                    <img :src="'../img/' + post.picture" style="width:70px; margin:5px">
                                </div>

                                <div class="col-md-10">
                                    <h3>@{{post.name}}</h3>
                                    <p><i class="fa fa-globe"></i> @{{post.city}} | @{{post.country}}</p>
                                    <small><b>Gender: </b>@{{post.gender}}</small><br>
                                    <small>@{{post.created_at}}</small>
                                </div>
                                <p class="col-md-12" style="color:#333">@{{post.content}}</p>
                            </div><br><hr>
                        </div> 
                    </div>
                </div>
                
            </div>

            <div class="col-md-3 right-sidebar">
                <h3 align="center">Right Sidebar</h3>
                <hr>
            </div>

            
        </div>
    </div>
{{-- </div> --}}

@endsection


{{-- <div class="col-md-7 left-sidebar">
    <h1>@{{msg}} <small style="color:green">@{{content}}</small></h1>
    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addPost"><br>
      <textarea class="form-control" v-model="content"></textarea><br>
        <button type="submit" class="btn btn-success">Submit</button><br><br>
    </form>

    <div class="panel panel-default">
        <div v-for="post in posts">
            <div class="col-md-12" style="background-color:#fff">
                <div class="col-md-2 pull-left">
                    <img :src="'../img/' + post.picture" style="width:100px; margin:10px">
                </div>
                <div class="col-md-10">
                    <h3>@{{post.name}}</h3>
                    <p><i class="fa fa-globe"></i> @{{post.city}} - @{{post.country}}</p>
                    <small class="gender"><b>Gender: </b>@{{post.gender}}</small><br>
                    <small>@{{post.created_at}}</small>
                </div>
                <p class="col-md-12" style="color:#333">@{{post.content}}</p>
            </div><br><hr>
        </div> 
    </div>
</div> --}}
