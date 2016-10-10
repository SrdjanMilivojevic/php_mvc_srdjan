@extends('layouts/app')

@section('content')
<div class="containder">
	<div class="jumbotron">
		<h1 class="text-center"> {{$note or ''}}</h1>
		<h2 class="text-center">
		{{ isset($param) ? 'Param: ' . $param : '' }}
		</h2>
	</div>
	@foreach($users->collection as $user)
		<p>{{$user->id}}</p><br>
	@endforeach

	<div class="well">
		<p>{!!$users->links!!}</p>
	</div>
	{!!flash()!!}
</div>
@stop
