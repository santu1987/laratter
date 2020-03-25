<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    //
    //Relacion con usuarios
    public function user(){
    	return $this->belongsTo(User::class);
    }
    //Relacion una respuesta a su mensaje
    public function message(){
    	$this->belongsTo(Message::class);
    }
}
