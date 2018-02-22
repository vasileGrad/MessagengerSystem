<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Friendship;
use App\Notification;


class ProfileController extends Controller
{
    public function index($slug) {

    	$userData = DB::table('users')
    		->leftJoin('profiles', 'profiles.user_id', 'users.id')
    		->where('slug', $slug)
    		->get();

    	//dd($userData);

    	return view('profile.index', compact('userData'))->with('data', Auth::user()->profile);
    }

    public function uploadPhoto(Request $request) {

    	$file = $request->file('picture');
    	$filename = $file->getClientOriginalName();
    	
    	$path = "../public/img";
    	$file->move($path, $filename);

    	$user_id = Auth::user()->id;

    	DB::table('users')->where('id', $user_id)->update(['picture' => $filename]);
    	return redirect('profile/index');
    }

    public function editProfileForm() {
    	return view('profile.editProfile');
    }

    public function findFriends() {
    	$uid = Auth::user()->id;
    	$allUsers = DB::table('profiles')->leftJoin('users', 'users.id', '=', 'profiles.user_id')->where('users.id', '!=', $uid)->get();

    	return view('profile.findFriends', compact('allUsers'));
    }

    public function sendRequest($id) {
    	
    	// Friendable - create function
    	Auth::user()->addFriend($id); 
    	return back(); 
    }

    public function requests() {
    	$uid = Auth::user()->id;

    	$friendRequests = DB::table('friendships')
    		->rightJoin('users', 'friendships.requester', '=', 'users.id')
    		->where('status', 0) // if status 0 than I have requested else 1 for I accept
    		->where('friendships.user_requested', '=', $uid)->get();

    	return view('profile.requests', compact('friendRequests'));
    }

    public function accept($name, $id)
    {
    	/*echo $id;
    	die();*/
    	$uid = Auth::user()->id;
    	$checkRequest = Friendship::where('requester', $id)
    			->where('user_requested', $uid)
    			->first();
    	if($checkRequest)
    	{
    		//echo "yes, update here";
    		// update table
    		$updateFriendship = DB::table('friendships')->where('user_requested', $uid)
    			->where('requester', $id)
    			->update(['status' => 1]);
    		//dd($updateFriendship);


			// adding into the table notifications
			$notifications = new Notification;
			$notifications->user_hero = $id;  // the id of the person accepted
			$notifications->user_logged = Auth::user()->id;  // who is accepting my request
			$notifications->status = '1';  // unread notifications
			$notifications->note = 'acceted you friend request';
			$notifications->save();


    		if ($notifications) {
    			return back()->with('msg', 'You are now Friend with this ' . $name);
    		}
    	}
    	else
    	{
    		return back()->with('msg', 'Something is wrong');
    	}
    }

    public function friends() {
        $uid = Auth::user()->id;

		// who send me request
    	$friends1 = DB::table('friendships') 
    			->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not logged in but send request to
    			->where('status', 1)
    			->where('requester', $uid) // who is logged in 
    			->get();

    	//dd($friends1);

		// I sent request to which users
    	$friends2 = DB::table('friendships')
    			->leftJoin('users', 'users.id', 'friendships.requester') // who is logged in send request to
    			->where('status', 1)
    			->where('user_requested', $uid) 
    			->get();

    	//dd($friends2);
    	$friends = array_merge($friends1->toArray(), $friends2->toArray());
    	//dd($friends);
    	return view('profile.friends', compact('friends'));
    }

    public function requestRemove($id) {
    	//echo $id;
    	DB::table('friendships')
    		->where('user_requested', Auth::user()->id)
    		->where('requester', $id)
    		->delete();

    	return back()->with('msg', 'Request has been deleted');
    }

    public function notifications($id) 
    {
    	$uid = Auth::user()->id;

    	$notes = DB::table('notifications') 
	        ->leftJoin('users', 'users.id', 'notifications.user_logged') 
	        ->where('notifications.id', $id)
	        ->where('user_hero', $uid)
	        ->orderBy('notifications.created_at', 'desc')
	        ->get();
	    //dd($notes);

        $updateNotifications = DB::table('notifications')
			->where('notifications.id', $id)
			->update(['status' => 0]);

	    return view('profile.notifications', compact('notes'));
    }

    public function unfriend($id) {

        $loggedUser = Auth::user()->id;

        DB::table('friendships')
        ->where('requester', $id)
        ->where('user_requested', $loggedUser)
        ->delete();

        return back()->with('msg', 'You are not friend with this person');
    }

    public function sendMessage(Request $request) {
        $conID = $request->conID;
        $msg = $request->msg;

        // fetch user_to
        $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
            ->where('user_to', '!=', Auth::user()->id)
            ->get();

        $user_to = $fetch_userTo[0]->user_to;

        // now send message
        $sendM = DB::table('messages')->insert([
            'user_to'         => $user_to,
            'user_from'       => Auth::user()->id,
            'msg'             => $msg,
            'status'          => 1,
            'conversation_id' => $conID
        ]);

        if($sendM){
            $userMsg = DB::table('messages')
                ->join('users', 'users.id', 'messages.user_from')
                ->where('messages.conversation_id', $conID)->get();
            return $userMsg;
        }else{
            echo 'not sent';
        }
    }
}
