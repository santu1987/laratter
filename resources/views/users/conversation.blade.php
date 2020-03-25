@extends('layouts.app')
@section('content')
<!--Metodo implode permite obviar o exceptuar usuarios...-->
<!-- implode para determinar el campo que se mostrará y que separador tendrá-->
<h1>Conversación con {{ $conversation->users->except($user->id)->implode('name', ', ') }}</h1>

@foreach($conversation->privateMessages as $message)
	<div class="card">
		<div class="card-header">
			{{ $message->user->name}} dijo...
		</div>	
		<div class="card-block">
			{{ $message->message }}
		</div>
		<div class="card-footer">
			{{ $message->created_at }}
		</div>
	</div>
@endforeach
@endsection