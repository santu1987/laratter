<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home');
Route::get('/locale','PagesController@locale');

///Una ruta tipo /messages/1
//Wish to programing

Auth::routes();
//Para ir a facebook desde un controlador
Route::get('/auth/facebook','SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');

Route::get('/home', 'HomeController@index');
Route::get('/api/messages/{message}/responses','MessagesController@responses');
//Ruta para busquedas
Route::get('/messages','MessagesController@search');
Route::get('/messages/{message}','MessagesController@show');

//Route::get('/home', 'HomeController@index')->name('home');
//--Creo un ngrupo, en el cual agrupare rutas que requieren autenticación 
Route::group(['middleware'=>'auth'], function(){
	//---------------------------------------------------
	Route::post('/messages/create','MessagesController@create');//->middleware('auth');
	//Para mostrar la conversacion
	Route::get('/conversations/{conversation}', 'UserController@showConversation');
	Route::post('/{username}/dms','UserController@sendPrivateMessage');

	Route::post('/{username}/follow','UserController@follow');
	Route::post('/{username}/unfollow','UserController@unfollow');
	Route::get('/api/notifications','UserController@notifications');
	//---------------------------------------------------
});
//A quien sigue el usuario de la url:
Route::get('/{username}/follows','UserController@follows');
Route::get('/{username}/followers', 'UserController@followers');
Route::get('/{username}', 'UserController@show');