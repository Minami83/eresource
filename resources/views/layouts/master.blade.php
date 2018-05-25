<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/w3.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  	<style type="text/css">
  		a,a:hover,a:visited,a:link,a:active{
  			text-decoration: none;
  		}
  		@media (max-width:992px){
  			#eresourcelogo{
  				height: 100%;
  				width: 100%;
  			}
  			body{
  				font-size: 0.8em
  			}
  		}
  		@media (min-width:992px){
  			#eresourcelogo{
  				height: 59px;
  				width: 190px;
  			}
  		}
  		@yield('style')
  	</style>
</head>
<body>
	<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
	<div id="navbardiv">
		@include('layouts.navbar')
	</div>

	<div id="main">
		@yield('isi')
	</div>

	<script type="text/javascript">
		$(window).ready(function(){
			if ($(window).width() >= 992) {
		 		var height = $('#navbar').height();
			 	height+=30;
				document.getElementById("main").style.marginTop = height+"px";
			}
			else if($(window).width() < 992){
				var height = $('#navbar').height();
			 	height+=15;
				document.getElementById("main").style.marginTop = height+"px";
			}
		});
		$(window).resize(function(){
			if ($(window).width() >= 992) {
		 		var height = $('#navbar').height();
			 	height+=30;
				document.getElementById("main").style.marginTop = height+"px";
			}
			else if($(window).width() < 992){
				var height = $('#navbar').height();
			 	height+=15;
				document.getElementById("main").style.marginTop = height+"px";
			}
		});
	</script>
</body>
</html>