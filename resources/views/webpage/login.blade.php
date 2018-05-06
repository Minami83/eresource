@extends('layouts.master2')
@section('title')
	Login
@endsection()

@section('style')
	input.empty {
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
	}
@endsection()

@section('isi')
	
	<div class="w3-row" style="margin-top: 150px">
		<div class="w3-center"><img src="/image/eresourcelogo.png" style="width: 225px"></div><br>
		<div class="col-sm-4"></div>
		<div class="w3-card col-sm-4 w3-white w3-round-large">
			<br>
		    <form action="{{ route('login') }}" method="POST">
		    	{{ csrf_field() }}
		        <div class="form-group">
		            <input id="email" type="email" class="w3-round-xlarge iconified empty form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="&#xf0e0;   {{ __('E-Mail Address') }}" required autofocus>

		            @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
		        </div>
		        <div class="form-group">
		            <input id="password" type="password" class="w3-round-xlarge iconified empty form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="&#xf023;     {{ __('Password') }}" required>
		            @if ($errors->has('password'))
	                    <span class="invalid-feedback">
	                        <strong>{{ $errors->first('password') }}</strong>
	                    </span>
	                @endif
		        </div>
		        <div class="checkbox">
                    <label style="float: left">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                    </label>
                </div>
                <a style="float: right" class="btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                <br><br>
                <div>
		        	<button style="width: 100%" class="btn waves-effect waves-light" type="submit"> {{ __('Login') }}
		        	</button>
		        </div>
		        <br>
		         <p class="">Belum punya akun? <a class="btn-link" href="#login"><i>Sign Up</i></a></p>
                
		    </form>
		</div>
		<div class="col-sm-4"></div>
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
		$('#iconified').on('keyup', function() {
		    var input = $(this);
		    if(input.val().length === 0) {
		        input.addClass('empty');
		    } else {
		        input.removeClass('empty');
		    }
		});

		$(document).ready(function(){
			var width1 = document.getElementById("email").style.width;
		    document.getElementById("btnlogin").style.width=width1;
		});

	</script>
@endsection()