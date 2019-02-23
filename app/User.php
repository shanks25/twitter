<?php

namespace App;
use App\Post;
use App\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','username'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'avatar',

    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getAvatar()
    {
        return 'https://s.gravatar.com/avatar/'.md5($this->email).'?s=50';
    }

    public function getAvatarAttribute()
    {
        return $this->getAvatar();
    }

    public function following()
    {
      return  $this->belongsToMany(User::class,'follows','user_id','follower_id');
  }

 


  public function isFollowing(User $user)
  {
     return (bool)  $this->following->where('id',$user->id)->count();
 }

 public function notsame(User $user)
 {
    return $this->id !== $user->id;
}


public function canFollow(User $user)
{
    if (!$this->notsame($user)) {
        return false;
    }
    return !$this->isFollowing($user) ;
}

public function canUnFollow(User $user)
{
    if (!$this->notsame($user)) {
        return false;
    }
    return $this->isFollowing($user) ; 
}
}
