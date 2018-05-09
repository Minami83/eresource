@extends('webpage.mastercourse')

@section('title')
	Maritime Economics & Logistics Palgrave
@endsection()

@section('titlejurnal')
	{{$jurnal[2]->fullName}}
@endsection()

@section('howto')
	@foreach (	$howto_text as $txt)
		<p>{{$txt}}</p>
	@endforeach
@endsection()

@section('video')
	<video width="320" height="240" controls id="vid1">
		<source src="{{$jurnal[2]->video}}" type="video/mp4">
	</video>
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