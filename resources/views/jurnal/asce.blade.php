@extends('webpage.mastercourse')

@section('title')
	ASCE Library
@endsection()

@section('titlejurnal')
	{{$jurnal[0]->fullName}}
@endsection()

@section('howto')
	@foreach ($howto_text as $txt)
		<p>{{$txt}}</p>
	@endforeach
@endsection()

@section('video')
	<video width="320" height="240" controls id="vid1">
		<source src="{{$jurnal[0]->video}}" type="video/mp4">
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
		@for ($i = 0; $i < sizeof($myJurnal); $i++)
			@if ($myJurnal[$i]->id==$jurnal[0]->id)
				$("#btnprev").hover(function(){
			        $(this).css("color", "white");
			        $(this).css("background-color", "white");
			    });
			    $("#btnprev").css("color", "white");
				$("#btnnext").html("{{$myJurnal[$i+1]->name}} &#10095;");
				@if ($i+2 <= $user->progress)
					$("#btnnext").css('display','block');
				@else
				    $("#accord1").click(function(){
				        $("#btnnext").fadeIn();
				    });
					document.getElementById('vid1').addEventListener('ended',myHandler,false);
				    function myHandler(e) {
					    $("#btnnext").fadeIn();
				    }
				@endif
			@endif
		@endfor
	});

@endsection()