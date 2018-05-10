@extends('layouts.master2')
@section('title')
	Register
@endsection()

@section('style')
	.empty {
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
	}
@endsection()

@section('isi')
	
	<div class="w3-row" style="margin-top: 30px">
		<div class="w3-center"><img src="/image/eresourcelogo2.png" style="width: 150px"></div><br>
		<div class="col-sm-4"></div>
		<div class="w3-card col-sm-4 w3-white w3-round-large">
			<br>
		    <form method="POST" action="{{ route('register') }}">
		    	@csrf
		        <div class="form-group">
		            <input id="nrp" type="text" class="w3-round-xlarge iconified empty form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nrp" value="{{ old('nrp') }}" placeholder="&#xf007;     {{ __('NRP') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
		        </div>
		        <div class="form-group">
		            <input id="name" type="text" class="w3-round-xlarge iconified empty form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="&#xf2b9;    {{ __('Nama') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
		        </div>
		        <div class="form-group">
                    <select class="w3-round-xlarge iconified empty form-control" name="faculty" id="facultyoption" required>
                    <option disabled="true" selected>-- Fakultas --</option>
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
                    <select class="w3-round-xlarge iconified empty form-control" name="department" id="departoption" required>
                    	<option disabled="true" selected>-- Departemen --</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" id="phone" class="w3-round-xlarge iconified empty form-control" value="{{ old('phone') }}" name="phone" placeholder="&#xf095;    {{ __('Nomor Telepon') }}" required>
                </div>
                <div class="form-group">
                    <input name="email" input id="email" type="email" class="w3-round-xlarge iconified empty form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="&#xf0e0;   {{ __('Email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="w3-round-xlarge iconified empty form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="&#xf023;    {{ __('Password') }}" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="w3-round-xlarge iconified empty form-control" name="password_confirmation" placeholder="&#xf01e;   {{ __('Confirm Password') }}" required>
                </div>
                <button style="width: 100%" class="btn waves-effect waves-light" type="submit" name="action">Register
                </button><br><br>
		        <p class="">Already have an account? <a class="btn-link" href="#login"><i>Login</i></a></p>
	    	</form>
		</div>
		<div class="col-sm-4"></div>
	</div>	

	<div class="row" id="signup" class="signup">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			
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
	        $("select#facultyoption").change(function(){
	            var selectedCountry = $("#facultyoption option:selected").val();
	            if(selectedCountry=="FAKULTAS TEKNOLOGI INDUSTRI"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Teknik Mesin'>Teknik Mesin</option><option value='Teknik Fisika'>Teknik Fisika</option><option value='Teknik Industri'>Teknik Industri</option><option value='Teknik Material'>Teknik Material</option><option value='Teknik Kimia'>Teknik Kimia</option>");
	            }
	            else if(selectedCountry=="FAKULTAS TEKNOLOGI KELAUTAN"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Teknik Perkapalan'>Teknik Perkapalan</option><option value='Teknik Sistem Perkapalan'>Teknik Sistem Perkapalan</option><option value='Teknik Kelautan'>Teknik Kelautan</option><option value='Transportasi Laut'>Transportasi Laut</option>");
	            }
	            else if(selectedCountry=="FAKULTAS TEKNOLOGI ELEKTRO"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Teknik Elektro'>Teknik Elektro</option><option value='Teknik Biomedik'>Teknik Biomedik</option><option value='Teknik Komputer'>Teknik Komputer</option>");
	            }
	            else if(selectedCountry=="FAKULTAS TEKNIK SIPIL, LINGKUNGAN, DAN KEBUMIAN"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Teknik Sipil'>Teknik Sipil</option><option value='Teknik Lingkungan'>Teknik Lingkungan</option><option value='Teknik Geomatika'>Teknik Geomatika</option><option value='Teknik Geofisika'>Teknik Geofisika</option>");
	            }
	            else if(selectedCountry=="FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Informatika'>Informatika</option><option value='Sistem Informasi'>Sistem Informasi</option><option value='Teknologi Informasi'>Teknologi Informasi</option>");
	            }
	            else if(selectedCountry=="FAKULTAS ARSITEKTUR, DESAIN, DAN PERENCANAAN"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Arsitektur'>Arsitektur</option><option value='Perencanaan Wilayah dan Kota'>Perencanaan Wilayah dan Kota</option><option value='Desain Produk Industri'>Desain Produk Industri</option><option value='Desain Interior'>Desain Interior</option>");
	            }
	            else if(selectedCountry=="FAKULTAS SAINS"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Fisika'>Fisika</option><option value='Kimia'>Kimia</option><option value='Biologi'>Biologi</option>");
	            }
	            else if(selectedCountry=="FAKULTAS MATEMATIKA, KOMPUTASI, DAN SAINS DATA"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Matematika'>Matematika</option><option value='Statistika'>Statistika</option><option value='Aktuaria'>Aktuaria</option>");
	            }
	            else if(selectedCountry=="FAKULTAS VOKASI"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Teknik Infrastruktur Sipil'>Teknik Infrastruktur Sipil</option><option value='Teknik Mesin Industri'>Teknik Mesin Industri</option><option value='Teknik Elektro Otomasi'>Teknik Elektro Otomasi</option><option value='Teknik Kimia Industri'>Teknik Kimia Industri</option><option value='Teknik Instrumentasi'>Teknik Instrumentasi</option><option value='Statistika Bisnis'>Statistika Bisnis</option>");
	            }
	            else if(selectedCountry=="FAKULTAS BISNIS DAN MANAJEMEN TEKNOLOGI"){
	                $('#departoption').empty();
	                $('#departoption').append("<option value='Manajemen Bisnis'>Manajemen Bisnis</option><option value='Manajemen Teknologi'>Manajemen Teknologi</option><option value='Studi Pembangunan'>Studi Pembangunan</option>");
	            }
	        });
	    });

	</script>
@endsection()