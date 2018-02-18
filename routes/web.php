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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return Auth::user()->test();
});


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

	Route::get('editProfile', 'ProfileController@editProfileForm');

	Route::get('/addFriend/{id}', 'ProfileController@sendRequest');

	Route::get('/requests', 'ProfileController@requests');

	Route::get('/accept/{name}/{id}', 'ProfileController@accept');

	Route::get('/friends', 'ProfileController@friends');

	Route::get('/requestRemove/{id}', 'ProfileController@requestRemove');

	Route::get('/messages2', function () {
	    return view('messages.messages2');
	});
});

Route::get('logout', 'Auth\LoginController@logout');




