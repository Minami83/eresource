@extends('webpage.mastercourse')

@section('title')
	Ship & Boat International Digital - RINA
@endsection()

@section('titlejurnal')
	{{$jurnal[4]->fullName}}
@endsection()

@section('howto')
	@foreach ($howto_text as $txt)
		<p>{{$txt}}</p>
	@endforeach
@endsection()

@section('video')
	<video width="320" height="240" controls id="vid1">
		<source src="{{$jurnal[4]->video}}" type="video/mp4">
	</video>
@endsection()

@section('morescript')
	$(document).ready(function(){
		$("#5").addClass("active")
	});

	$(document).ready(function(){
		@for ($i = 0; $i < sizeof($myJurnal); $i++)
			@if ($myJurnal[$i]->id==$jurnal[4]->id)
				$("#btnprev").html("&#10094; {{$myJurnal[$i-1]->name}}");
				$("#btnprev").attr("href","{{$myJurnal[$i-1]->name}}");
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