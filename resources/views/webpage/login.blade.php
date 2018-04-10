@extends('layouts.master')
@section('title')
	Home
@endsection()

@section('isi')
	<div class="jumbotron text-center">
		<h1>E-Resource ITS</h1> 
	</div>
	
	<div class="row" id="login" class="login">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		    <form action="" method="post">
		    	<h1>Login</h1><br>
		    	{{ csrf_field() }}
		        <div class="form-group">
		            <label for="username">Username</label><br>
		            <input type="text" id="username" class="form-control" name="username">
		        </div>
		        <div class="form-group">
		            <label for="password">Password</label><br>
		            <input type="password" id="password" class="form-control" name="password">
		        </div>
		        <button class="btn waves-effect waves-light" type="submit" name="action">Login
		        </button>
		        <p>Don't have an account? <a id="changesign" href="#signup"><i>Sign Up</i></a></p>
		    </form>
		</div>
		<div class="col-sm-2"></div>
	</div>	

	<div class="row" id="signup" class="signup" style="display: none">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<form action="" method="post">
		    	<h1>Register</h1><br>
		    	{{ csrf_field() }}
		        <div class="form-group">
		            <label for="username">NRP</label><br>
		            <input type="text" id="nrp" class="form-control" name="nrp">
		        </div>
		        <div class="form-group">
		            <label for="name">Name</label><br>
		            <input type="text" id="name" class="form-control" name="name">
		        </div>
		        <div class="form-group">
		        	<label for="faculty">Faculty</label>
					<select class="form-control" name="faculty">
						<option disabled="true" selected="true">-- Please select your faculty --</option>
						<option value="FAKULTAS TEKNOLOGI INDUSTRI">FAKULTAS TEKNOLOGI INDUSTRI</option>
						<option value="FAKULTAS TEKNOLOGI KELAUTAN">FAKULTAS TEKNOLOGI KELAUTAN</option>
						<option value="FAKULTAS TEKNOLOGI ELEKTRO">FAKULTAS TEKNOLOGI ELEKTRO</option>
						<option value="FAKULTAS TEKNIK SIPIL, LINGKUNGAN, DAN KEBUMIAN">FAKULTAS TEKNIK SIPIL, LINGKUNGAN, DAN KEBUMIAN</option>
						<option value="FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI">FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI</option>
						<option value="FAKULTAS ARSITEKTUR, DESAIN, DAN PERENCANAAN">FAKULTAS ARSITEKTUR, DESAIN, DAN PERENCANAAN</option>
						<option value="FAKULTAS SAINS">FAKULTAS SAINS</option>
						<option value="FAKULTAS MATEMATIKA, KOMPUTASI, DAN SAINS DATA">FAKULTAS MATEMATIKA, KOMPUTASI, DAN SAINS DATA</option>
						<option value="FAKULTAS VOKASI">FAKULTAS VOKASI</option>
						<option value="FAKULTAS BISNIS DAN MANAJEMEN TEKNOLOGI">FAKULTAS BISNIS DAN MANAJEMEN TEKNOLOGI</option>
					</select>
				</div>
		        <div class="form-group">
		            <label for="phone">Phone</label><br>
		            <input type="text" id="phone" class="form-control" name="phone">
		        </div>
		        <div class="form-group">
		            <label for="email">Email</label><br>
		            <input type="email" id="email" class="form-control" name="email">
		        </div>
		        <div class="form-group">
		            <label for="password">Password</label><br>
		            <input type="password" id="password" class="form-control" name="password" >
		        </div>
		        <button class="btn waves-effect waves-light" type="submit" name="action">Register
		        </button>
		        <p class="">Already have an account? <a id="changelog" href="#login"><i>Login</i></a></p>
	    	</form>
		</div>
		<div class="col-sm-2"></div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#signup').removeClass('signup');
			$('#changesign').click(function(){
				var dest = $(this).attr('href');
				$('#login').css("display","none");
				$('#login').removeClass('login');
				$(dest).fadeIn();
				return false;  
			});
			$('#changelog').click(function(){
				var dest = $(this).attr('href');
				$('#signup').css("display","none");
				$('#signup').removeClass('signup');
				$(dest).fadeIn();
				return false;  
			});
		});
	</script>
@endsection()