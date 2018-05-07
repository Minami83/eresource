@extends('layouts.master')

@section('isi')
	<br><br>
	<div class="container">
		<br><br><h2>Post-test</h2><br>
		<form class="container" method="POST" action="/action_page.php">
			@foreach($posttest as $post)
			<label>{{$post->id}}. {{$post->question}}</label><br>
			<input class="w3-radio" type="radio" name="{{$post->choice_1}}">{{$post->choice_1}}<br>
			<input class="w3-radio" type="radio" name="{{$post->choice_2}}">{{$post->choice_2}}<br>
			<input class="w3-radio" type="radio" name="{{$post->choice_3}}">{{$post->choice_3}}<br>
			<input class="w3-radio" type="radio" name="{{$post->choice_4}}">{{$post->choice_4}}<br><br>
			@endforeach

			<button class="w3-button w3-dropdownnavbar" type="submit">Submit
		</form>
	</div>
@endsection()