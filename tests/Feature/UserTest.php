<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
class UserTest extends TestCase{
	//Es para que no se guarde en base de datos 
	use DatabaseTransactions;
	//Este nos permitira preguntarle a la bd si ve algun cambio
	use InteractsWithDatabase;

	public function testCanSeeUserPage(){
		$user = factory(User::class)->create();
		$response = $this->get($user->username);
		$response->assertSee($user->name);
	}
	//---test al momento de login
	public function testCanLogin(){
		//Creo un usuario
		$user = factory(User::class)->create();
		$response = $this->post('/login',[
			'email'=> $user->email,
			'password'=>'secret'
		]);
		//para verificar si la persona creada se logueo
		$this->seeIsAuthenticatedAs($user);
	}
	//Para saber si un dato llego o no a la base de datis
	public function testCanFollow(){
		//Obtuvimos dos usuarios
		$user = factory(User::class)->create();
		$other = factory(User::class)->create();
		//Hicimos un follow login como el primer usuario con actingAs
		$response = $this->actingAs($user)->post($other->username.'/follow');
		//Visualizamos si afecto a la bd...
		$this->assertDatabaseHas('followers',[
			'user_id'=> $user->id,
			'followed_id'=>$other->id
		]);
	}
}