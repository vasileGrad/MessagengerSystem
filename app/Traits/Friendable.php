<?php 

namespace App\Traits;
use App\Friendship;

trait Friendable
{
	public function test() {
		return 'hi';
	}

	public function addFriend($id) {
		//echo 'adding friend';
		$friendship = Friendship::create([
			'requester' => $this->id, // who is logged in
			'user_requested' => $id,
		]);

		if($friendship)
		{
			return $friendship;
		}
		else
		{
			return 'failed';
		}
	}
}