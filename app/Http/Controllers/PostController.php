<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index() {

    	$posts = DB::table('posts')->get();

    	return view('posts', compact('posts'));
    }

    public function addPost(Request $request) {
    	$content = $request->content;

    	DB::table('posts')->insert(
    		['user_id' => Auth::user()->id, 'content' => $content, 
    		'status' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s") ]);

    	/*DB::table('notifications')->insert(['user_logged' => 0, 'user_hero' => 0, 'status' => 0, 'note' => 'grad vasile']);*/
    	
    }
}
