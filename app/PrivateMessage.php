<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    //Permitir que se cree un mensaje con todos los parametros necesarios
    protected $guarded = [];
    //Un mensaje privado pertenece a un user
    public function user(){
    	return $this->belongsTo(User::class);
    } 
}
