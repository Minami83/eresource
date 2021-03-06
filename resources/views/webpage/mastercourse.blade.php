@extends('layouts.master3')

@section('title')
	{{$myJurnal[$index]->name}}
@endsection(
)
@section('style')
	a:hover {
		text-decoration:none;
	}

	.w3-sidebar{
		height:calc(100% - 60px);
		width:300px;
		display:none;
		z-index:5;
		overflow: auto;
	}

	.active {
	    color: #ffc410;
	}

	.accordion {
		background-color:white;
	    padding: 18px;
	    width: 100%;
	    border: none;
	    text-align: left;
	    outline: none;
	    font-size: 15px;
	    transition: 0.4s;
	}

	.active2, .accordion:hover {
	}

	.accordion:after {
	    content: '\002B';
	    color: #777;
	    font-weight: bold;
	    float: right;
	    margin-left: 5px;
	}

	.active2:after{
		content: '\2212';
	}

	.panel {
	    padding: 0 18px;
	    background-color: white;
	    max-height: 0;
	    overflow: hidden;
	    transition: max-height 0.2s ease-out;
	}

	.takkebuka, .takkebuka:hover{
		color:white!important;
		background-color:#ccc!important;
		cursor:not-allowed;
		text-decoration:none
	}
	.kebuka{
		color:black!important;
		background-color:none!important;
		cursor:pointer;
	}

@endsection

@section('isi')
	@include('layouts.sidebar')

	<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

	<div class="w3-main" style="margin-left:300px; margin-top: 60px">
		<br>
		<div class="w3-light-grey w3-round-xlarge" style="margin-left: 30px; margin-right: 30px">
			<div id="myBar" class="w3-container w3-biru w3-round-xlarge w3-center" ></div>
		</div>
		<br>
		<h2 style="padding: 0px 18px">{{$myJurnal[$index]->fullName}}</h2><br>
		<h5 style="padding: 0px 18px">{{$myJurnal[$index]->description}}</h5><br>
		<button class="accordion" id="accord1" onclick="accordionfunc(this.id)">How to:</button>
		<div class="panel">
			@php
				$text = file($myJurnal[$index]->howto);
			@endphp
	  		@foreach ($text as $txt)
				<p>{{$txt}}</p>
			@endforeach
			{{-- @yield('howto') --}}
		</div>
		<button class="accordion" id="accord2" onclick="accordionfunc(this.id)">Video</button>
		<div class="panel">
			<video controls id="vid1">
				<source src="{{$myJurnal[$index]->video}}" type="video/mp4">
			</video>
	  		{{-- @yield('video') --}}
		</div>{{-- 
		<button class="accordion" id="accord3" onclick="accordionfunc(this.id)">Tutorial</button>
		<div class="panel">
	  		@yield('tutorial')
		</div> --}}
		<br><br>
		<form id="formstatistik" method="post" action="/next">
			@csrf
			<input id="accord1input" type="hidden" name="accord1input" value="0">
			<input id="accord2input" type="hidden" name="accord2input" value="0">
			{{-- <input id="accord3input" type="hidden" name="accord3input" value="0"> --}}
			<input name="url" value="{{substr(Request::path(),7)}}" type="hidden">
			<div class="w3-border w3-round" style="margin-right:30px;margin-left:30px;">
				<a id="btnprev" class="w3-button">&#10094; Previous</a>
				<a id="btnnext" class="w3-button w3-right" style="display: none">Next &#10095;</a>
			</div>
			{{-- <div>
				<button id="nextbutton" class="btn btn-4 btn-4c icon-arrow-right w3-right w3-dropdownnavbar" type="submit" style="display: none;">Next</button>
			</div> --}}
		</form>
	</div>
	<br><br><br>

	<script type="text/javascript">
		$("#btnnext").click(function(){
		    $("#formstatistik").submit();
		    return false;
	    });
		$(window).ready(function(){
			if ($(window).width() >= 992) {
				w3_close();
				$('#mySidebar').css("top","60px");
		 		$('#mySidebar').css("height","calc(100% - 60px)");
		 		$('#vid1').attr("height","480");
		    	$('#vid1').attr("width","640");
			}
			else if($(window).width() < 992){
				$('#mySidebar').css("top","0px");
		    	$('#mySidebar').css("height","100%");
		    	$('#vid1').attr("height","100%");
		    	$('#vid1').attr("width","100%");
			}
		});
		$(window).resize(function(){
			if ($(window).width() >= 992) {
				w3_close();
				$('#mySidebar').css("top","60px");
		 		$('#mySidebar').css("height","calc(100% - 60px)");
		 		$('#vid1').attr("height","480");
		    	$('#vid1').attr("width","640");
			}
			else if($(window).width() < 500){
				$('#mySidebar').css("top","0px");
		    	$('#mySidebar').css("height","100%");
		    	$('#vid1').attr("height","100%");
		    	$('#vid1').attr("width","100%");
			}
		});

		$(document).ready(function(){
			$("#"+{{$myJurnal[$index]->id}}).addClass("active")
		});

		$(document).ready(function(){
			@if ($index==0)
				$("#btnprev").hover(function(){
			        $(this).css("color", "white");
			        $(this).css("background-color", "white");
			    });
			    $("#btnprev").css("color", "white");
			    @if(sizeof($myJurnal)==1)
			        $("#btnnext").html("Posttest &#10095;");
			    @else
				    $("#btnnext").html("{{$myJurnal[$index+1]->name}} &#10095;");
				@endif
			@elseif ($index==sizeof($myJurnal)-1)
				$("#btnprev").html("&#10094; {{$myJurnal[$index-1]->name}}");
				$("#btnprev").attr("href","{{$myJurnal[$index-1]->name}}");
				@if ($user->progress<=sizeof($myJurnal))
					$("#btnnext").html("Posttest &#10095;");
				@else
					$("#btnnext").html("Home &#10095;");
				@endif
			@else
				$("#btnprev").html("&#10094; {{$myJurnal[$index-1]->name}}");
				$("#btnprev").attr("href","{{$myJurnal[$index-1]->name}}");
				$("#btnnext").html("{{$myJurnal[$index+1]->name}} &#10095;");
			@endif

			@if ($index+2 <= $user->progress)
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
		});
		$(document).ready(function(){
			var elem = document.getElementById("myBar");
		    var width=({{$progress}})*100;
		    elem.style.width = width + '%';
		    elem.innerHTML = parseFloat(width).toFixed(0) + '%';
		});

		$(document).ready(function(){
			var header = document.getElementById("mySidebar");
			var btn = header.getElementsByClassName("w3-bar-item");
			var temp={{$user->progress}}+1;
			for (var i = temp; i <= btn.length; i++) {
				btn[i].className+=' takkebuka';
				btn[i].removeAttribute('href');
			}
		});

		function accordionfunc(accordid){
			var accord=document.getElementById(accordid);
		    accord.classList.toggle("active2");
		    var panel = accord.nextElementSibling;
		    if (panel.style.maxHeight){
		      panel.style.maxHeight = null;
		    } else {
		      panel.style.maxHeight = panel.scrollHeight + "px";
		    }
		    if(accordid=='accord1'){
		    	$('#accord1input').attr('value', '1')
		    }
		    else if(accordid=='accord2'){
		    	$('#accord2input').attr('value', '1')
		    }
		    else if(accordid=='accord3'){
		    	$('#accord3input').attr('value', '1')
		    }
		}

		function w3_open() {
		    document.getElementById("mySidebar").style.display = "block";
		    document.getElementById("myOverlay").style.display = "block";
		    $('#mySidebar').css("top","0px");
		    $('#mySidebar').css("height","100%");
		}
		function w3_close() {
		    document.getElementById("mySidebar").style.display = "none";
		    document.getElementById("myOverlay").style.display = "none";
		}

		@yield('morescript')
	</script>
@endsection
