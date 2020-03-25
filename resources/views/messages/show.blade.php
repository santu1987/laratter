@extends('layouts.app')
@section('content')
<h1 class="h3"> Mensaje id:{{ $message->id }}</h1>
<!--<img class="img-thumbnail" src="{{ $message->image }}">
<p class="card-text">
	{{ $message->content }}
	<small class="text-mutted"> {{ $message->created_at}}</small>
</p>-->
@include('messages.message')

<responses :message="{{ $message->id }}"></responses>
@endsection