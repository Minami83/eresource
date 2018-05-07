@extends('layouts.master')

@section('isi')
	<br><br>
	<div class="container">
		<br><br><h2>Pre-test</h2><br>
		<form class="container" method="POST" action="/action_page.php">
			@foreach($pretest as $pre)
			<label>{{$pre->id}}. {{$pre->question}}</label><br>
			<input class="w3-radio" type="radio" name="{{$pre->choice_1}}">{{$pre->choice_1}}<br>
			<input class="w3-radio" type="radio" name="{{$pre->choice_2}}">{{$pre->choice_2}}<br>
			<input class="w3-radio" type="radio" name="{{$pre->choice_3}}">{{$pre->choice_3}}<br>
			<input class="w3-radio" type="radio" name="{{$pre->choice_4}}">{{$pre->choice_4}}<br><br>
			@endforeach

			<button class="w3-button w3-dropdownnavbar" type="submit">Submit
		</form>
	</div>
@endsection()