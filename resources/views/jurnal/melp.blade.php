@extends('webpage.mastercourse')

@section('title')
	Maritime Economics & Logistics Palgrave
@endsection()

@section('titlejurnal')
	Palgrave McMillan-Maritime Economics & Logistics
@endsection()

@section('howto')

@endsection()

@section('video')

@endsection()

@section('tutorial')

@endsection()

@section('morescript')
	$(document).ready(function(){
		$("#3").addClass("active")
	});

	$(document).ready(function(){
		var temp={{$user->progress}};
		if(temp>=4){
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
		if(temp>=4){
			$("#nextbutton").css('display','block');
		}
		else{	
	        $("#nextbutton").fadeIn();
	    }
    }
@endsection()