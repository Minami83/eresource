@extends('layouts.master')

@section('isi')
	<br><br>
	<div class="container">
		<br><br><h2>Post-test</h2><br>
		<form class="container" method="post" action="/postans">
			@csrf
			@foreach($posttest as $post)
			<label>{{$post->id}}. {{$post->question}}</label><br>
			<input class="w3-radio" type="radio" value="{{$post->choice_1}}" name={{$post->id}}>{{$post->choice_1}}<br>
			<input class="w3-radio" type="radio" value="{{$post->choice_2}}" name={{$post->id}}>{{$post->choice_2}}<br>
			<input class="w3-radio" type="radio" value="{{$post->choice_3}}" name={{$post->id}}>{{$post->choice_3}}<br>
			<input class="w3-radio" type="radio" value="{{$post->choice_4}}" name={{$post->id}}>{{$post->choice_4}}<br><br>
			@endforeach

			<button class="w3-button w3-dropdownnavbar" type="submit">Submit
		</form>
	</div>
@endsection()
