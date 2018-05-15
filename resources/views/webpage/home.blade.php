@extends('layouts.master')

@section('title')
	E-Resource Class
@endsection()

@section('isi')

	<div class="w3-center container" style="margin-top: 200px">
		<h1 class="w3-animate-opacity">E-Resource Class</h1><br>
		@if ($user->verified==2)
		<div class="col-sm-3"></div>
		<div class="col-sm-3">
			<a id="btn" class="homebutton w3-center w3-button w3-light-gray"></a>
		</div>
		<div class="col-sm-3">
			<a id="btn2" href="/sertif" class="homebutton w3-center w3-button w3-light-gray">Sertif</a>
		</div>
		@else
		<div class="w3-center">
			<a id="btn" class="homebutton w3-button w3-light-gray"></a>
		</div>
		@endif

	<script type="text/javascript">
		$(document).ready(function(){
			$('.homebutton').width('95');
			if({{$user->progress}}>=1){
				$("#btn").html('Continue');
				$("#btn").attr('href','/continue');
			}else{
				$("#btn").html('Start Course');
				$("#btn").attr('href','/pretest');
			}
		});
	</script>
@endsection()