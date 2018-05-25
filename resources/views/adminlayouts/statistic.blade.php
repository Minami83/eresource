<!DOCTYPE html>
<html>
<head>
	<title>Statistik</title>
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
		<div class="w3-top" id="navbar">
			<div class="w3-bar w3-large w3-biru">
		  		<a href="/home" class="w3-bar-item"><img id="eresourcelogo" src="/image/eresourcelogo.png"></a>
		    	<button class="w3-button w3-hover-none w3-hover-text-amber w3-hide-large w3-left w3-padding-16" style="height: 75px" onclick="w3_open()">&#9776;</button>
		    	@if($user->roleName()=='admin' || $user->roleName()=='pustakawan')
			    @php
			      $i=date('Y');
			    @endphp
			    <div class="w3-dropdown-hover w3-bar-item">
			    	<button class="w3-button w3-biru w3-padding-16 w3-hover-none w3-hover-text-amber">Menu</button>
			      	<div class="w3-dropdown-content w3-bar-block w3-border w3-card-4">
			        	<a href="/admin" id="verifikasinavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Verifikasi User</a>
			        	<a href="/admin/user/list" id="usernavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">User</a>
			        	<a href="/admin/jurnal/list" id="jurnalnavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Jurnal</a>
			        	<a href="/admin/test/list" id="testnavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Tes</a>
			      	</div>
			    </div>
		    	<div class="w3-dropdown-hover w3-bar-item">
		      		<button class="w3-button w3-biru w3-padding-16 w3-hover-none w3-hover-text-amber">Rekap</button>
		      		<div class="w3-dropdown-content w3-bar-block w3-border w3-card-4">
				        <a href="/admin/laporan/{{$i}}" id="laporannavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Laporan</a>
			          	<a href="/admin/logreport" id="lognavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Log</a>
			          	<a href="/admin/statistik" id="lognavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Statistik</a>
		      		</div>
		    	</div>
		    	@endif
		  		<div class="w3-dropdown-hover w3-right w3-bar-item">
			    	<button class="w3-button w3-biru w3-padding-16 w3-hover-none w3-hover-text-amber">{{$user->name}}</button>
			    	<div class="w3-dropdown-content w3-bar-block w3-border w3-card-4" style="right: 0">
			      		<a href="/profile" class="w3-bar-item w3-button w3-hover-none w3-hover-text-amber">Akun</a>
			      		<a href="{{ route('logout') }}" class="w3-bar-item w3-button w3-hover-none w3-hover-text-amber" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
		      		</div>
		    	</div>
		  	</div>
		  	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		    	@csrf
		  	</form>
		</div>
	</div>

	<div id="main">
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="display:none;
		z-index:5;" id="mySidebar">
			<button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
				<a class="w3-bar-item w3-button w3-hover-none w3-hover-text-amber" onclick="openpercent()">Persentase</a>
				<a class="w3-bar-item w3-button w3-hover-none w3-hover-text-amber" onclick="openlogin()">Jumlah Login</a>
				<a class="w3-bar-item w3-button w3-hover-none w3-hover-text-amber" onclick="openjurnal()">Jumlah Jurnal</a>
		</div>
		
		<div style="margin-left: 200px;width: calc(100% - 200px);margin-top: 110px" id="chartcontainer">
		    <div class="container" id="mhsdosencount"></div>
			<script type="text/javascript">
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart1);
				function drawChart1() {
					var data = google.visualization.arrayToDataTable([
						['Partisipan', 'Persentase'],
						['Mahasiswa', {{$mhsdosenCount[0]}}],
						['Dosen', {{$mhsdosenCount[1]}}],
					]);
					var options = {
						title: 'Persentase Mahasiswa & Dosen',
					};
		        var chart = new google.visualization.PieChart(document.getElementById('mhsdosencount'));
		        chart.draw(data, options);
		      }
		    </script>

		    <div class="container hidden" id="logincount"></div>
		    <script type="text/javascript">
		    	google.charts.load('current', {'packages':['bar']});
		    	google.charts.setOnLoadCallback(drawChart2);
		    	function drawChart2() {
			        var data = google.visualization.arrayToDataTable([
			        	['Bulan', 'Login'],
			        	['Jan', {{$loginCount[0]}}],
			        	['Feb', {{$loginCount[1]}}],
			        	['Mar', {{$loginCount[2]}}],
			        	['Apr', {{$loginCount[3]}}],
			        	['Mei', {{$loginCount[4]}}],
			        	['Jun', {{$loginCount[5]}}],
			        	['Jul', {{$loginCount[6]}}],
			        	['Ags', {{$loginCount[7]}}],
			        	['Sep', {{$loginCount[8]}}],
			        	['Okt', {{$loginCount[9]}}],
			        	['Nov', {{$loginCount[10]}}],
			        	['Des', {{$loginCount[11]}}],
			        ]);
			        var options = {
			        	chart: {
			        		title: 'Jumlah Login',
			        		subtitle: 'Banyaknya proses login pada tiap bulan',
			        	}
			        };
		        var chart = new google.charts.Bar(document.getElementById('logincount'));
		        chart.draw(data, google.charts.Bar.convertOptions(options));
		      }
		    </script>

		    <div class="container hidden" id="jurnalcount"></div>
		    <script type="text/javascript">
		    	google.charts.load('current', {'packages':['bar']});
		    	google.charts.setOnLoadCallback(drawChart3);
		    	function drawChart3() {
		    		var data = google.visualization.arrayToDataTable([
		    			['Jurnal', 'Jumlah'],
		          		['ASCE', {{$jurnalCount[0]}}],
		          		['ASME', {{$jurnalCount[1]}}],
		          		['MELP', {{$jurnalCount[2]}}],
		          		['TNA RINA', {{$jurnalCount[3]}}],
		          		['SBID RINA', {{$jurnalCount[4]}}],
		          		['SMD RINA', {{$jurnalCount[5]}}],
		          		['IJME', {{$jurnalCount[6]}}],
		          		['IJSCT', {{$jurnalCount[7]}}],
		          		['JSPD', {{$jurnalCount[8]}}],
		          		['JSR', {{$jurnalCount[9]}}],
		          		['Marine', {{$jurnalCount[10]}}],
		          		['Springerlink', {{$jurnalCount[11]}}],
		          		['Emerald', {{$jurnalCount[12]}}],
		          		['GALE', {{$jurnalCount[13]}}],
		          		['IEEE', {{$jurnalCount[14]}}],
		          		['EBSCO', {{$jurnalCount[15]}}],
		          		['ProQuest', {{$jurnalCount[16]}}],
			         	['Sciencedir', {{$jurnalCount[17]}}],
		          		['Nature', {{$jurnalCount[18]}}],
		        	]);

		        	var options = {
		          		chart: {
		            		title: 'Jurnal',
		            		subtitle: 'Banyaknya jurnal yang dijadikan course',
		          		},
		        	};
		        var chart = new google.charts.Bar(document.getElementById('jurnalcount'));
		        chart.draw(data,google.charts.Bar.convertOptions(options));
		      }
		    </script>
		</div>


	    <script type="text/javascript">
	    	$(document).ready(function(){
	    		$('#mhsdosencount').css('height','500px');
	    		$('#logincount').css('height','500px');
	    		$('#jurnalcount').css('height','500px');
	    	})

	    	$(window).ready(function(){
				if ($(window).width() >= 992) {
					w3_close();
					$('#mySidebar').css("top","75px");
			 		$('#mySidebar').css("height","calc(100% - 75px)");
				}
				else if($(window).width() < 992){
					$('#mySidebar').css("top","0");
			    	$('#mySidebar').css("height","100%");
			    	$('#chartcontainer').css("margin-left","0px");
	    			$('#mhsdosencount').css('width',$(window).width() + "px");
		    		$('#logincount').css('width',$(window).width() + "px");
		    		$('#jurnalcount').css('width',$(window).width() + "px");
				}
			});
			$(window).resize(function(){
				if ($(window).width() >= 992) {
					w3_close();
					$('#mySidebar').css("top","75px");
			 		$('#mySidebar').css("height","calc(100% - 75px)");
				}
				else if($(window).width() < 992){
					$('#mySidebar').css("top","0");
			    	$('#mySidebar').css("height","100%");
			    	$('#chartcontainer').css("margin-left","0px");
			    	$('#mhsdosencount').css('width',$(window).width() + "px");
		    		$('#logincount').css('width',$(window).width() + "px");
		    		$('#jurnalcount').css('width',$(window).width() + "px");
				}
			});

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
			function openpercent(){
				google.charts.setOnLoadCallback(drawChart1);
				$('#mhsdosencount').removeClass('hidden');
				$('#logincount').addClass('hidden');
				$('#jurnalcount').addClass('hidden');
			}
			function openlogin(){
				$('#mhsdosencount').addClass('hidden');
				google.charts.setOnLoadCallback(drawChart2);
				$('#logincount').removeClass('hidden');
				$('#jurnalcount').addClass('hidden');
			}
			function openjurnal(){
				$('#mhsdosencount').addClass('hidden');
				$('#logincount').addClass('hidden');
				google.charts.setOnLoadCallback(drawChart3);
				$('#jurnalcount').removeClass('hidden');
			}
	    </script>

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