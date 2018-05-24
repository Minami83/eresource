@extends('layouts.master')

@section('title')
	E-Resource Class
@endsection()

@section('isi')
	<div class="w3-center container">
		@if ($user->verified==0)
			<h1 class="w3-animate-opacity">Mohon Tunggu Proses Verifikasi dari Administrator</h1><br>
		@else
			@if (session('alert'))
	            <div id="alertfail" class="alert alert-danger">
					{{ session('alert') }}
				</div>
	        @endif
			<h1 class="w3-animate-opacity">E-Resource Class</h1><br>
			@if ($user->verified==2)
			<div class="w3-center">	
				<a id="btn1" href="/continue" class="homebutton w3-center w3-button w3-light-gray">Review</a>
				@if ($user->roleName()=='partisipan')
				<a id="btn2" href="/sertif" class="homebutton w3-center w3-button w3-light-gray">Sertif</a>
				<a id="btn3" href="/testscore" class="homebutton w3-center w3-button w3-light-gray">Skor Test</a>
				@endif
			</div>
			@else
			<div class="w3-center">
				<a id="btn" class="homebutton w3-button w3-light-gray"></a>
			</div>
			@endif
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