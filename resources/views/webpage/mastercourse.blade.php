@extends('layouts.master')

@section('title')
	Home
@endsection

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



@endsection

@section('isi')
	@include('layouts.sidebar')

	<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

	<div class="w3-main" style="margin-left:300px">
		<button class="accordion">How to:</button>
		<div class="panel">asd
	  		@yield('howto')
		</div>
		<button class="accordion">Video</button>
		<div class="panel">
	  		@yield('video')
		</div>
		<button class="accordion">Tutorial</button>
		<div class="panel">
	  		@yield('tutorial')
		</div>
	</div>

	<script type="text/javascript">
		
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
		  acc[i].addEventListener("click", function() {
		    this.classList.toggle("active2");
		    var panel = this.nextElementSibling;
		    if (panel.style.maxHeight){
		      panel.style.maxHeight = null;
		    } else {
		      panel.style.maxHeight = panel.scrollHeight + "px";
		    } 
		  });
		}

		function w3_open() {
		    document.getElementById("mySidebar").style.display = "block";
		    document.getElementById("myOverlay").style.display = "block";
		}
		function w3_close() {
		    document.getElementById("mySidebar").style.display = "none";
		    document.getElementById("myOverlay").style.display = "none";
		}
		
		var header = document.getElementById("mySidebar");
		var btn = header.getElementsByClassName("w3-bar-item w3-button");
		for (var i = 0; i < btn.length; i++) {
			btn[i].addEventListener("click", function() {
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace(" active", "");
				this.className += " active";
			});
		}
	</script>
@endsection