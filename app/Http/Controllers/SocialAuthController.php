<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Socialite;
class SocialAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //Metodos para redes sociales------------
    //----------------------------------------
    public function facebook(){
        //Pra redirigir a facebook
        return Socialite::driver('facebook')->redirect();
    }
    //----------------------------------------
    public function callback(){
        //Para obtener el usuario de facebook, facebook provee de estos datos
        $user = Socialite::driver('facebook')->user();
    }
}