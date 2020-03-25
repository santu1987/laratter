<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;
use App\PrivateMessage;
use App\User;
use App\Notifications\UserFollowed;

class UserController extends Controller
{
    //
    public function show($username){
    	//throw new \Exception("Simulando un error.");
        //$user = User::where('username',$username)->first();//Donde tenga ese username , devuelve solo uno
    	$user = $this->findByUsername($username);
    	return view('users.show',[
    		'user'=>$user,
    		
    	]);
    }

    public function follow($username, Request $request){
    	$user= $this-> findByUsername($username);
    	$me = $request->user();

    	//Guarde en follows el id del usuario que desea seguior
    	$me->follows()->attach($user);

        //Para generar la notificacion....
        $user->notify(new UserFollowed($me));
        //
    	return redirect("/$username")->withSuccess('Usuario seguido!');
    }
   
    //Para dejar de seguri un usuario
    public function unfollow($username, Request $request){
        $user= $this-> findByUsername($username);
        $me = $request->user();

        //Guarde en follows el id del usuario que desea seguior
        $me->follows()->detach($user);

        return redirect("/$username")->withSuccess('Usuario no seguido!');
    }
   //Mostranmos uhjn usuario y sus follows
    public function follows($username){
    	//$user = User::where('username',$username)->first();//Donde tenga ese username , devuelve solo uno
    	$user = $this->findByUsername($username);
    	return view('users.follows',[
    		'user'=>$user,
            'follows'=>$user->follows,
    		
    	]);	
    }
    //funcion que reciba el usuario y busque
    public function followers($username){
        $user = $this->findByUsername($username);
        return view('users.follows',[
            'user' => $user,
            'follows'=> $user->followers,
        ]);
    }
    //Metodo para que el usuario logueado envie un mensaje privado a otro usuario
    public function sendPrivateMessage($username, Request $request){
        $user = $this->findByUsername($username);

        $me = $request->user();
        $message = $request->input('message');
        //Para poder ver todos los mensajes de una conversacion
        $conversation = Conversation::between($me,$user);
        //Creo el objeto de la conversacion
        //$conversation = Conversation::create();
        //Una conversacion tiene muchos usuarios
        //Para agregar usarios a la conversacion
       // $conversation->users()->attach($me);
        //$conversation->users()->attach($user);

        //Creo un mensaje privado
        $privateMessage = PrivateMessage::create([
            'conversation_id'=> $conversation->id,
            'user_id' => $me->id,
            'message' => $message,
        ]);

        //redirijo al usuario a la conversacion
        return redirect('/conversations/'.$conversation->id);
    } 
    //Metodo para mostrar las conversaciones...
    public function showConversation(Conversation $conversation){
        //Quiero que cargue sus mensajes y sus usuarios
        $conversation->load('users','privateMessages');
        //dd($conversation);
        return view('users.conversation',[
            'conversation' => $conversation,
            'user' => auth()->user(),
        ]);
    }
    //Crea una funcíon privada para no estar repitiendo el codigo
    private function findByUsername($username){
    	return User::where('username',$username)->firstOrFail();//Donde tenga ese username , devuelve solo uno

    }
    public function notifications(Request $request){
        return $request->user()->notifications;
    }
}
