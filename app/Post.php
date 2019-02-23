<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable=['body'];
	protected $appends=['diffForHumans'];

	public function user()
	{	
		return $this->belongsTo(User::class);
	}

	public function getdiffForHumansAttribute()
	{
		return $this->created_at->diffForHumans();
	}


}
