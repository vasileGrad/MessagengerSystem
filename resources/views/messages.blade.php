@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="row">
    	<div class="col-sm-3" style="background-color: #fff">
    		<h3 align="center">Click on user</h3>
            <ul v-for="privateMsg in privateMsgs">
                <li @click="messages(privateMsg.id)" style="list-style:none; margin-top:10px; background-color:#ddd">
                    <img :src="'../img/' + privateMsg.picture" style="width:50px; border-radius:50%"/>
                    @{{privateMsg.name}}
                    <p>Here we will display message</p>
                </li>
            </ul>
    		<hr>
    	</div>

    	<div class="col-sm-6" style="background-color: #fff">
    		<h3 align="center">Messages</h3>
            <div v-for="singleMsg in singleMsgs">

                <div v-if="singleMsg.user_from == <?php echo Auth::user()->id; ?>">
                    <div style="float:right; background-color:#f0f0f0; padding:15px; margin:20px; text-align:right; color:#333; border-radius:10px" class="col-md-9">
                        <b>@{{singleMsg.user_from}}</b> @{{singleMsg.msg}} @{{singleMsg.user_to}} <br>
                    </div>
                </div>

                <div v-else=>
                    <div style="float:left; background-color:#0084ff; padding:15px; margin:20px; color:#fff; border-radius:10px" class="col-md-9">
                        <b>@{{singleMsg.user_from}}</b> @{{singleMsg.msg}} @{{singleMsg.user_to}} <br>
                    </div>
                </div>

                
            </div>
    		<hr>
    	</div>

    	<div class="col-sm-3" style="background-color: #fff">
    		<h3 align="center">User Information</h3>
    		<hr>
    	</div>


    </div>
</div>
@endsection
