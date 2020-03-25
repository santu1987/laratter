<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // usuario tiene muchos mensajes
    public function messages(){
        return $this->hasMany(Message::class)->orderBy('created_at','desc');//messages tiene user_id, y son muchos de ellos
    }
    //para follows:quienes me siguen
    public function follows(){
        return $this->belongsToMany(User::class,'followers','user_id','followed_id');
    }
    //para followers: a quien sigo
    public function followers(){
        return $this->belongsToMany(User::class,'followers','followed_id','user_id');
    }
    //Para devolver si el usuario contiene al usuario en cuestion
    public function isFollowing(User $user){
        return $this->follows->contains($user);//Este metodo retorna un boolena si el usuario es contenido en los followers
    }
}

