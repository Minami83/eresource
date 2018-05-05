@extends('webpage.mastercourse')

@section('title')
	ASCE Library
@endsection()

@section('titlejurnal')
	American Society of Civil Engineers (ASCE)
@endsection()

@section('howto')
<video width="320" height="240" controls id="vid1">
  <source src="/video/vid1.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
@endsection()

@section('video')
<video width="320" height="240" controls id="vid1">
  <source src="/video/vid1.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
@endsection()

@section('tutorial')
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
		var temp={{$user->progress}};
		if(temp>=1){
			$("#nextbutton").css('display','block');
		}
		else{
		    $("#accord1").click(function(){
		        $("#nextbutton").fadeIn();
		    });
		}
	});

	document.getElementById('vid1').addEventListener('ended',myHandler,false);
    function myHandler(e) {
    	var temp={{$user->progress}};
		if(temp>=1){
			$("#nextbutton").css('display','block');
		}
		else{	
	        $("#nextbutton").fadeIn();
	    }
    }

@endsection()