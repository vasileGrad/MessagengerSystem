@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="row">
    	<div class="col-sm-3" style="background-color: #fff">
    		<h3 align="center">User</h3>
            <ul v-for="privateMsg in privateMsgs">
                <li style="list-style:none; margin-top:10px; background-color:#ddd">
                    <img :src="'../img/' + privateMsg.picture" style="width:50px; border-radius:50%"/>
                    @{{privateMsg.name}}
                    <p>Here we will display message</p>
                </li>
            </ul>
    		<hr>
    	</div>

    	<div class="col-sm-6" style="background-color: #fff">
    		<h3 align="center">Center Sidebar</h3>
    		<hr>
    	</div>

    	<div class="col-sm-3" style="background-color: #fff">
    		<h3 align="center">Right Sidebar</h3>
    		<hr>
    	</div>


    </div>
</div>
@endsection
