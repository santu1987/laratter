<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //Creo 50 usuarios y por cada uno creo 20 mensajes, se e indica el user_id 
        $users = factory(App\User::class,50)->create();
        //Se le coloca use para poder utilizar $user dentro de el foreach
        $users->each(function(App\User $user) use($users) {
            $messages = factory(App\Message::class)
                            ->times(20)
                            ->create([
                                'user_id' => $user->id,
                            ]);//especifico el usuario
            //---------------------------------------------
            $messages->each(function(App\Message $message)use($users){
                factory(App\Response::class, random_int(1,10))->create([
                            'message_id'=>$message->id,
                            'user_id'=>$users->random(1)->first()->id,
                ]);
            });                
            //-------------------------------------------                
            //Sigue a 50 usuarios al azar
            $user->follows()->sync(
                $users->random(10)
            );
        });
       
    }
}
