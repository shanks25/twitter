<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth');
	}
 
public function index()
{
    return view('home');
}


public function store(Request $request,Post $post)
{
	$this->validate($request,[
		'body'=>'required'
	]);
   $createdPost =$request->user()->posts()->create([
   	'body' => $request->body,
   ]);
   return response()->json($post->with('user')->find($createdPost->id),200);
}

public function profile($id)
{   
   $user= User::find($id);
   return view('user.profile')->withUser($user);
}
}
