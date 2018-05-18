@extends('layouts.master')

@section('title')
	Sertifikat {{$user->name}}
@endsection()

@section('isi')
	<div class="container" style="margin-top: 65px">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 w3-center">
				<h1 style="font-family: Calibri;">Congratulation, {{$user->name}}</h1>
			</div>
			<div class="col-sm-2"></div><br><br><br>
			<div class="col-sm-2"></div>
			<div class="col-sm-8 w3-center">
				<a href="/" download>
					<img style="width: 95%" id="sertif" src="">
				</a>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var temp = "{{$user->name}}";
			var temp2 = temp.replace(/ /g, "%20");
			$("#sertif").attr('src','/image/'+temp2+'.jpg');
			$("a").attr('href','/image/'+temp2+'.jpg');
		});
	</script>
@endsection()