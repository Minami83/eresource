@extends('webpage.mastercourse')

@section('title')ASCE Library
@endsection()

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

	$(document).ready(function(){
	    $("#accord1").click(function(){
	        $("#nextbutton").fadeIn();
	        $("#nextbutton").attr('href','asme');
	        $("#2").attr('href','asme');
	    });
	});

	document.getElementById('vid1').addEventListener('ended',myHandler,false);
    function myHandler(e) {
        $("#nextbutton").fadeIn();
        $("#nextbutton").attr('href','asme');
        $("#2").attr('href','asme');
    }

@endsection()