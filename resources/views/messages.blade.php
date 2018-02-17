@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="row">
    	<div class="col-sm-3" style="background-color: #fff">
    		<h3 align="center">@{{msg}}</h3>
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
