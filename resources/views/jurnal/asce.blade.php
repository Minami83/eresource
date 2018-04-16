@extends('webpage.mastercourse')

@section('video')
<video width="320" height="240" controls id="vid1">
  <source src="/video/vid1.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
@endsection()

@section('morescript')
	$(document).ready(function(){
		$("#1").addClass("active")
	});
@endsection()