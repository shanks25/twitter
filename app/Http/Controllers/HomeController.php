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

public function allposts(Request $request,Post $post)
{ 

return $allposts =  Post::whereIn('user_id',$request->user()->following()->pluck('follower_id')->push($request->user()->id)) ->with('user')->get();
 $posts = $allposts->take($request->get('limit', 20))->orderBy('created_at', 'desc')->get();
 return response()->json([
  'posts' => $posts,
  'total' => $allposts->count(),
]);
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

public function follow(Request $request,$id)
{
  $user=User::find($id);
  if ($request->user()->canFollow($user)) {
    $request->user()->following()->attach($user);
  }
  return back();

}

public function unfollow(Request $request,$id)
{
  $user=User::find($id);
  if ($request->user()->canUnFollow($user)) {
    $request->user()->following()->detach($user);
  }
  return back();
}


}
