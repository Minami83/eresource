@extends('webpage.mastercourse')

@section('title')
	The Naval Architect - RINA
@endsection()

@section('titlejurnal')
	The Naval Architect - RINA
@endsection()

@section('howto')
ini how to
@endsection()

@section('video')
ini video
@endsection()

@section('morescript')
	$(document).ready(function(){
		$("#4").addClass("active")
	});

	$(document).ready(function(){
		var temp={{$user->progress}};
		if(temp>=5){
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
		if(temp>=5){
			$("#nextbutton").css('display','block');
		}
		else{	
	        $("#nextbutton").fadeIn();
	    }
    }
@endsection()