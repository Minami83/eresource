@extends('layouts.master')

@section('isi')
	<div class="container">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<h2>Post-test</h2><br>
			<form method="post" action="/postans">
				@csrf
				@foreach($posttest as $post)
				<label>{{$loop->iteration}}. {{$post->question}}</label><br>
					<input class="w3-radio" type="radio" name="{{$post->id}}" value="{{$post->choice_1}}">{{$post->choice_1}}<br>
					<input class="w3-radio" type="radio" name="{{$post->id}}" value="{{$post->choice_2}}">{{$post->choice_2}}<br>
					<input class="w3-radio" type="radio" name="{{$post->id}}" value="{{$post->choice_3}}">{{$post->choice_3}}<br>
					<input class="w3-radio" type="radio" name="{{$post->id}}" value="{{$post->choice_4}}">{{$post->choice_4}}<br><br>
				@endforeach

				<button class="w3-button w3-dropdownnavbar" type="submit">Submit</button>
			</form>
		</div>
	</div>
@endsection()
