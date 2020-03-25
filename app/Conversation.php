<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    public function users(){
    	//Relacion un usuario puede tener muchas conversaciones 
    	return $this->belongsToMany(User::class);
    }
    public function privateMessages(){
    	//Una conversacion, tiene muchos menajes privados...
    	return $this->hasMany(PrivateMessage::class)->orderBy('created_at','desc');
    	//---
    }
    //Metodo para 
    public static function between(User $user, User $other){
    	//COnsulta las conversaciones que tiene este usuario y las que tengas el otro usuario
    	$query = Conversation::whereHas('users', function($query) use($user){
   		 	$query->where('user_id',$user->id);
 	    })->whereHas('users', function($query) use($other){
   		 	$query->where('user_id', $other->id);
    	});
    	//Metodo que si existe la devuelve sino la crea con esos atributos
    	//Siempre va a tener un objeto creation
 	    $conversation = $query->firstOrCreate([]);
    	//sincronizo la conversacion
    	$conversation->users()->sync([
    		$user->id, $other->id
    	]);
    	return $conversation;
    }	
}
