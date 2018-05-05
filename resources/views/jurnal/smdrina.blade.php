@extends('webpage.mastercourse')

@section('title')
	Shiprepair & Maintenance Digital - RINA
@endsection()

@section('titlejurnal')
	Shiprepair & Maintenance Digital - RINA
@endsection()

@section('howto')
ini how to
@endsection()

@section('video')
ini video
@endsection()

@section('morescript')
	$(document).ready(function(){
		$("#6").addClass("active")
	});

	$(document).ready(function(){
		var temp={{$user->progress}};
		if(temp>=7){
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
		if(temp>=7){
			$("#nextbutton").css('display','block');
		}
		else{	
	        $("#nextbutton").fadeIn();
	    }
    }
@endsection()