@extends('layouts.master')

@section('title')
	E-Resource Class
@endsection()

@section('isi')
	<div class="w3-center container" style="margin-top: 200px">
		<h1 class="w3-animate-opacity">E-Resource Class</h1><br>
		<div class="">
			<a id="btn" class="w3-button"></a>
		</div>

	<script type="text/javascript">
		$(document).ready(function(){
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