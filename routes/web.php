<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return Auth::user()->test();
});

Route::get('/test1', function () {
    $noti = DB::table('notifications')	
    	->where('user_logged', Auth::user()->id)
    	->get();
    dd($noti);
});

Route::get('/test1count', function () {
    $count = App\Notification::where('status', 1)  // unread
    	->where('user_hero', Auth::user()->id)
    	->count();

    dd($count);
});

/*Route::get('/', function () {
     return view('welcome');
 });*/

Route::get('/', function () {
	$posts = DB::table('posts')
		->leftJoin('profiles', 'profiles.user_id', 'posts.user_id')
		->leftJoin('users', 'posts.user_id', 'users.id')
		->orderBy('posts.created_at', 'desc')->take(2)
		->get();

    return view('welcome', compact('posts'));
});

Route::get('/posts', function () {
	$posts_json = DB::table('posts')
		->leftJoin('profiles', 'profiles.user_id', 'posts.user_id')
		->leftJoin('users', 'posts.user_id', 'users.id')
		->orderBy('posts.created_at', 'desc')->take(2)
		->get();

    return $posts_json;
});

Route::post('addPost', 'PostController@addPost');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index');
	Route::get('profile/{slug}', 'ProfileController@index');

	Route::get('/profile', function () {
	    return view('profile.index');
	});
	Route::get('/changePhoto', function() {
		return view('profile.picture');
	});

	Route::post('/uploadPhoto', 'ProfileController@uploadPhoto');
	
	Route::get('/findFriends', 'ProfileController@findFriends');

	Route::get('/editProfile', 'ProfileController@editProfileForm');

	Route::get('/addFriend/{id}', 'ProfileController@sendRequest');

	Route::get('/requests', 'ProfileController@requests');

	Route::get('/accept/{name}/{id}', 'ProfileController@accept');

	Route::get('/friends', 'ProfileController@friends');

	Route::get('/requestRemove/{id}', 'ProfileController@requestRemove');

	Route::get('/notifications/{id}', 'ProfileController@notifications');
	
	Route::get('/unfriend/{id}', 'ProfileController@unfriend');
	
});

Route::post('/sendMessage', 'ProfileController@sendMessage');

Route::get('/messages', function () {
	/*$privateMsgs = DB::table('users')	
    	->where('id', '!=', Auth::user()->id)
    	->get();

    return view('/messages', compact('privateMsgs'));*/
	    return view('messages');
	});

Route::get('/getMessages', function () {
	// the persons who sent me messages
    $allUsers1 = DB::table('users')	
    	->Join('conversations', 'users.id', 'conversations.user_one')
    	->where('conversations.user_two', Auth::user()->id)
    	->get();
    //return $allUsers;

    // the persons to whom I have sent the messages
    $allUsers2 = DB::table('users')	
    	->Join('conversations', 'users.id', 'conversations.user_two')
    	->where('conversations.user_one', Auth::user()->id)
    	->get();
    //dd($allUsers2);

    // combine all the users
    return array_merge($allUsers1->toArray(), $allUsers2->toArray());
});

Route::get('/getMessages/{id}', function ($id) {
    // check Conversation
    /*$checkCon = DB::table('conversations')->where('user_one', Auth::user()->id)
    	->where('user_two', $id)->get();
    if(count($checkCon)!=0){
    	//echo $checkCon[0]->id;
    	// fetch msgs
    	$userMsg = DB::table('messages')->where('messages.conversation_id', $checkCon[0]->id)->get();
    	return $userMsg;
    }else{
    	echo "no messages";
    }*/
    $userMsg = DB::table('messages')
    	->join('users', 'users.id', 'messages.user_from')
    	->where('messages.conversation_id', $id)->get();
    return $userMsg;
});

Route::get('logout', 'Auth\LoginController@logout');




