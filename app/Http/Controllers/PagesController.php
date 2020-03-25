<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    //
    /*public function home(){
    	$links = [
    			"https://platzi.com/laravel"=>'Curso Laravel',
    			"https://laravel.com" => 'Página laravel'
	    ];
	    return view('welcome',[
	    		'teacher' => 'Guido Contreras',
	    		'links'=> $links
	    ]);
    }*/
    public function home(){
        //--Creo 4 arrays indexados para los mensajes de los usuarios
        /*$messages = [
            [
                'id' => 1,
                'content' => 'Este es mi primer mensaje',
                'imagen' => 'https://lorempixel.com/600/338?1',
            ],
            [
                'id' => 2,
                'content' => 'Este es mi segundo mensaje',
                'imagen' => 'https://lorempixel.com/600/338?2',
            ],
            [
                'id' => 3,
                'content' => 'Este es mi tercer mensaje',
                'imagen' => 'https://lorempixel.com/600/338?3',
            ],
            [
                'id' => 4,
                'content' => 'Este es el último mensaje',
                'imagen' => 'https://lorempixel.com/600/338?4',
            ],            
        ];*/
        //--Para traer todos:
        //$messages = Message::all();
        //Que pagine de 10 en 10
        $messages = Message::latest()->paginate(10);
        return view('welcome',[
            'messages'=>$messages, 
            //'messages'=>[]      
        ]);
    }
    //
    public function locale(Request $request){
        session()->put('locale',$request->input('lang'));
        return back();
    }
}
