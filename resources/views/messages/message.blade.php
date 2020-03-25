<img class="img-thumbnail" src="{{$message->image}}">
<p class="card-text">
	<span class="text-muted">Escrito por 
		<a href="/{{ $message->user->username }}">
		{{ $message->user->name }}
		</a>
	</span>
	{{ $message['content']}}
	<span style="margin-left: 10px;"><a href="/messages/{{ $message['id']}}">Leer más</a></span>
</p>
<div class="card-text text-muted float-right">
	{{ $message->created_at}}
</div>