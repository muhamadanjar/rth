@extends('app')

@section('content')

	<div class="alert alert-success" role="alert">
		The post has been updated. To create a new post, click <a href="{{ action('LayerController@createNewLayer') }}" class="alert-link">here</a>.
		To manage existing posts, click <a href="{{ action('LayerController@viewAllLayer') }}" class="alert-link">here</a> instead.
	</div>

@stop