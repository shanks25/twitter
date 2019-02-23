@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-12">
     <h3>{{$user->username}}</h3>  
 	@if (Auth::user()->notsame($user))
 	@if (Auth::user()->isFollowing($user))
 		<a href="#"> UnFollow </a>
 		 @else
 		<a href="#"> Follow </a>
 	@endif
 	@endif
       </div>
   </div>
</div>
@endsection
