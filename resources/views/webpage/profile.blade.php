 @extends('layouts.master')
@section('title')
	{{$user->name}}
@endsection()

@section('style')
	.empty {
		border: none;
		border-color: transparent;
		border-bottom:1px solid black;
	}

	.editprofil{
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
	}

	.input{
		
	}
@endsection()

@section('isi')
	
	<div class="w3-row" style="margin-top: 70px">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 w3-white w3-round-large">
			<br>
		    <form method="POST" action="/profile">
		    	@csrf
		    	<table class="w3-table">
				<tr>
					<th>{{ __('NRP') }}</th>
					<td class="profb" style="display: block">: {{$user->nrp}}</td>
					<td class="profa" style="display: none">: 
						<input id="nrp" type="text" class="empty{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nrp" value="{{ old('nrp') }}" placeholder="{{$user->nrp}}" required autofocus>
	                    @if ($errors->has('name'))
	                        <span class="invalid-feedback">
	                            <strong>{{ $errors->first('name') }}</strong>
	                        </span>
	                    @endif
                    </td>
				</tr>
				<tr>
					<th>{{ __('Nama') }}</th>
					<td class="profb" style="display: block">: {{$user->name}}</td>
					<td class="profa" style="display: none">: 
						<input id="name" type="text" class="empty{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{$user->name}}" required autofocus>
	                    @if ($errors->has('name'))
	                        <span class="invalid-feedback">
	                            <strong>{{ $errors->first('name') }}</strong>
	                        </span>
	                    @endif
					</td>
				</tr>
				<tr>
					<th>{{ __('Fakultas') }}</th>
					<td class="profb" style="display: block">: {{$user->faculty}}</td>
					<td class="profa" style="display: none">: 
						<select class="empty" name="faculty" id="facultyoption" required>
	                    <option disabled="true" selected>{{$user->faculty}}</option>
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
					</td>
				</tr>
				<tr>
					<th>{{ __('Departemen') }}</th>
					<td class="profb" style="display: block;">: {{$user->department}}</td>
					<td class="profa" style="display: none;">: 
						<select class="empty" name="department" id="departoption" required>
	                    	<option disabled="true" selected>{{$user->department}}</option>
	                    </select>
					</td>
				</tr>
				<tr>
					<th>{{ __('Email') }}</th>
					<td class="profb" style="display: block;">: {{$user->email}}</td>
					<td class="profa" style="display: none;">: 
						<input name="email" input id="email" type="email" class="empty{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{$user->email}}" required>
	                    @if ($errors->has('email'))
	                        <span class="invalid-feedback">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
                    	@endif
					</td>
				</tr>
				<tr>
					<th>{{ __('Nomor Telepon') }}</th>
					<td class="profb" style="display: block;">: {{$user->phone}}</td>
					<td class="profa" style="display: none;">: 
						<input type="text" id="phone" class="empty" value="{{ old('phone') }}" name="phone" placeholder="{{$user->phone}}" required>
					</td>
				</tr>
				</table>
				<button id="btnsubmit" class="profa editprofil iconified" style="display: none" type="submit" name="action">Submit &#xf1d8;</button>	
	    	</form>
				<button id="btnubah" style="display: block" class="profb editprofil iconified" onclick="editprofil()">Edit Profil &#xf044;</button>
		</div>
		<div class="col-sm-3"></div>
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

		function editprofil(){
			$('.profb').css('display','none');
			$('.profa').css('display','block');
		}
	    $(document).ready(function(){
	        $("select#facultyoption").change(function(){
	            var selectedCountry = $("#facultyoption option:selected").val();
	            if(selectedCountry=="FAKULTAS TEKNOLOGI INDUSTRI"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Teknik Mesin'>Teknik Mesin</option><option value='Teknik Fisika'>Teknik Fisika</option><option value='Teknik Industri'>Teknik Industri</option><option value='Teknik Material'>Teknik Material</option><option value='Teknik Kimia'>Teknik Kimia</option>");
	            }
	            else if(selectedCountry=="FAKULTAS TEKNOLOGI KELAUTAN"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Teknik Perkapalan'>Teknik Perkapalan</option><option value='Teknik Sistem Perkapalan'>Teknik Sistem Perkapalan</option><option value='Teknik Kelautan'>Teknik Kelautan</option><option value='Transportasi Laut'>Transportasi Laut</option>");
	            }
	            else if(selectedCountry=="FAKULTAS TEKNOLOGI ELEKTRO"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Teknik Elektro'>Teknik Elektro</option><option value='Teknik Biomedik'>Teknik Biomedik</option><option value='Teknik Komputer'>Teknik Komputer</option>");
	            }
	            else if(selectedCountry=="FAKULTAS TEKNIK SIPIL, LINGKUNGAN, DAN KEBUMIAN"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Teknik Sipil'>Teknik Sipil</option><option value='Teknik Lingkungan'>Teknik Lingkungan</option><option value='Teknik Geomatika'>Teknik Geomatika</option><option value='Teknik Geofisika'>Teknik Geofisika</option>");
	            }
	            else if(selectedCountry=="FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Informatika'>Informatika</option><option value='Sistem Informasi'>Sistem Informasi</option><option value='Teknologi Informasi'>Teknologi Informasi</option>");
	            }
	            else if(selectedCountry=="FAKULTAS ARSITEKTUR, DESAIN, DAN PERENCANAAN"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Arsitektur'>Arsitektur</option><option value='Perencanaan Wilayah dan Kota'>Perencanaan Wilayah dan Kota</option><option value='Desain Produk Industri'>Desain Produk Industri</option><option value='Desain Interior'>Desain Interior</option>");
	            }
	            else if(selectedCountry=="FAKULTAS SAINS"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Fisika'>Fisika</option><option value='Kimia'>Kimia</option><option value='Biologi'>Biologi</option>");
	            }
	            else if(selectedCountry=="FAKULTAS MATEMATIKA, KOMPUTASI, DAN SAINS DATA"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Matematika'>Matematika</option><option value='Statistika'>Statistika</option><option value='Aktuaria'>Aktuaria</option>");
	            }
	            else if(selectedCountry=="FAKULTAS VOKASI"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Teknik Infrastruktur Sipil'>Teknik Infrastruktur Sipil</option><option value='Teknik Mesin Industri'>Teknik Mesin Industri</option><option value='Teknik Elektro Otomasi'>Teknik Elektro Otomasi</option><option value='Teknik Kimia Industri'>Teknik Kimia Industri</option><option value='Teknik Instrumentasi'>Teknik Instrumentasi</option><option value='Statistika Bisnis'>Statistika Bisnis</option>");
	            }
	            else if(selectedCountry=="FAKULTAS BISNIS DAN MANAJEMEN TEKNOLOGI"){
	                $('#departoption').empty();
	                $('#departoption').append("<option disabled='true' selected>-- Departemen --</option><option value='Manajemen Bisnis'>Manajemen Bisnis</option><option value='Manajemen Teknologi'>Manajemen Teknologi</option><option value='Studi Pembangunan'>Studi Pembangunan</option>");
	            }
	        });
	    });

	</script>
@endsection()