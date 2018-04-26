@extends('layouts.master')

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

	<div class="w3-main" style="margin-left:300px">
		<br>
		<div class="w3-light-grey w3-round-xlarge" style="margin-left: 50px; margin-right: 50px">
			<div id="myBar" class="w3-container w3-dropdownnavbar w3-round-xlarge w3-center" ></div>
		</div>
		<br>
		<button class="accordion" id="accord1" onclick="accordionfunc(this.id)">How to:</button>
		<div class="panel">
	  		@yield('howto')
		</div>
		<button class="accordion" id="accord2" onclick="accordionfunc(this.id)">Video</button>
		<div class="panel">
	  		@yield('video')
		</div>
		<button class="accordion" id="accord3" onclick="accordionfunc(this.id)">Tutorial</button>
		<div class="panel">
	  		@yield('tutorial')
		</div>
		<br><br><br>
		<form id="formstatistik" method="post" action="{{substr(Request::path(),7)}}/next">
			@csrf
			<input id="accord1input" type="text" name="accord1input" value="0">
			<input id="accord2input" type="hidden" name="accord2input" value="0">
			<input id="accord3input" type="hidden" name="accord3input" value="0">
			<div>
				<button class="w3-button w3-dropdownnavbar w3-right" id="nextbutton" style="display:none;margin-right: 70px" type=submit>Next</button>
			</div>
		</form>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var elem = document.getElementById("myBar");
		    var width=({{$user->progress}}/19)*100;
		    elem.style.width = width + '%';
		    elem.innerHTML = parseFloat(width).toFixed(0) + '%';
		});

		$(document).ready(function(){
			var header = document.getElementById("mySidebar");
			var btn = header.getElementsByClassName("w3-bar-item");
			var temp={{$user->progress}};
			for (var i = temp; i < btn.length; i++) {
				btn[i].className+=' takkebuka'
			}
		});

		$(document).ready(function(){
			var temp={{$user->progress}}
			if(temp>=1){
				$("#1").attr('href','asce');
			}
			if(temp>=2){
				$("#2").attr('href','asme');
			}
			if(temp>=3){
				$("#3").attr('href','melp');
			}
			if(temp>=4){
				$("#4").attr('href','tnarina');
			}
			if(temp>=5){
				$("#5").attr('href','sbidrina');
			}
			if(temp>=6){
				$("#6").attr('href','smdrina');
			}
			if(temp>=7){
				$("#7").attr('href','ijme');
			}
			if(temp>=8){
				$("#8").attr('href','ijsct');
			}
			if(temp>=9){
				$("#9").attr('href','jspd');
			}
			if(temp>=10){
				$("#10").attr('href','jsr');
			}
			if(temp>=11){
				$("#11").attr('href','marinetech');
			}
			if(temp>=12){
				$("#12").attr('href','springerlink');
			}
			if(temp>=13){
				$("#13").attr('href','emerald');
			}
			if(temp>=14){
				$("#14").attr('href','gale');
			}
			if(temp>=15){
				$("#15").attr('href','ieee');
			}
			if(temp>=16){
				$("#16").attr('href','ebsco');
			}
			if(temp>=17){
				$("#17").attr('href','proquest');
			}
			if(temp>=18){
				$("#18").attr('href','sciencedir');
			}
			if(temp>=19){
				$("#19").attr('href','nature');
			}
		});

		function increase() {
			// Increment database progress
			// wes pindah nde controller hapusen ae iki
		}

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
		    var sidebardisplay=document.getElementById("mySidebar");
			var overlaydisplay=document.getElementById("myOverlay");
		    sidebardisplay.style.display = "block";
		    overlaydisplay.style.display = "block";
		}
		function w3_close() {
			var sidebardisplay=document.getElementById("mySidebar");
			var overlaydisplay=document.getElementById("myOverlay");
		    sidebardisplay.style.display = "none";
		    overlaydisplay.style.display = "none";
		}
		function w3_toggle() {
			var sidebardisplay=document.getElementById("mySidebar");
			var overlaydisplay=document.getElementById("myOverlay");
		    if($("#mySidebar").css('display')=='block' && $("#myOverlay").css('display')=='block'){
		    	sidebardisplay.style.display='none';
		    	overlaydisplay.style.display='none';
		    }
		    else if($("#mySidebar").css('display')=='none' && $("#myOverlay").css('display')=='none'){
		    	sidebardisplay.style.display='block';
		    	overlaydisplay.style.display='block';
		    }
		}

		// var header = document.getElementById("mySidebar");
		// var btn = header.getElementsByClassName("w3-bar-item w3-button");
		// for (var i = 0; i < btn.length; i++) {
		// 	btn[i].addEventListener("click", function() {
		// 		var current = document.getElementsByClassName("active");
		// 		current[0].className = current[0].className.replace(" active", "");
		// 		this.className += " active";
		// 	});
		// }

		@yield('morescript')
	</script>
@endsection
