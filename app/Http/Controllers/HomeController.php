<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
            ->leftJoin('profiles', 'profiles.user_id', 'posts.user_id')
            ->leftJoin('users', 'posts.user_id', 'users.id')
            ->orderBy('posts.created_at', 'desc')->take(3)
            ->get();

    return view('home', compact('posts'));
    }
}
