@extends('layouts.master')

@section('title')
	Sertifikat {{$user->name}}
@endsection()

@section('isi')
	<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 w3-center">
				<h1 style="font-family: Calibri;">Congratulation, {{$user->name}}</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 w3-center">
				<a id="sertifdownload" href="/" download>
					<img style="width: 95%" id="sertif" src="">
				</a>
			</div>
			<div class="col-sm-2"></div>
		</div>
		<br><br>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var temp = "{{$user->name}}";
			var temp2 = temp.replace(/ /g, "%20");
			$("#sertif").attr('src','/image/'+temp2+'.jpg');
			$("#sertifdownload").attr('href','/image/'+temp2+'.jpg');
		});
	</script>
@endsection()