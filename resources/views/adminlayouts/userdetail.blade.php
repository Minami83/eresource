 @extends('layouts.master')
@section('title')
	{{$edituser->name}}
@endsection()

@section('style')
	.editprofil{
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
	}

	th{
		width:170px;
	}
	.btna{
		width:130px;
		height:30px;
		margin-top:10px;
		margin-left:16px;
		cursor:pointer;
	}
@endsection()

@section('isi')

	<div class="w3-row" style="margin-top: 70px">
		<div class="col-sm-3">
			<a href="/admin/user/list"><button style="float: right;margin-top: 30px"><i class="fa fa-reply"></i></button></a>
		</div>
		<div class="col-sm-6">
			<br>
		    <form method="POST" action="/admin/user/edit/{{$edituser->id}}">
		    	@csrf
		    	<table class="w3-table">
				<tr>
					<th>{{ __('ID') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$edituser->id_number}}</td>
					<td class="profa" style="display: none">
						<input id="nrp" type="text" class="w3-round-xlarge form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nrp" value="{{$edituser->id_number}}" autofocus>
	                    @if ($errors->has('name'))
	                        <span class="invalid-feedback">
	                            <strong>{{ $errors->first('name') }}</strong>
	                        </span>
	                    @endif
                    </td>
				</tr>
				<tr>
					<th>{{ __('Nama') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$edituser->name}}</td>
					<td class="profa" style="display: none">
						<input id="name" type="text" class="w3-round-xlarge form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$edituser->name}}" autofocus>
	                    @if ($errors->has('name'))
	                        <span class="invalid-feedback">
	                            <strong>{{ $errors->first('name') }}</strong>
	                        </span>
	                    @endif
					</td>
				</tr>
				<tr>
					<th>{{ __('Fakultas') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$edituser->faculty}}</td>
					<td class="profa" style="display: none">
						<select class="w3-round-xlarge form-control" name="faculty" id="facultyoption">
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
					<td>:</td>
					<td class="profb" style="display: block;">{{$edituser->department}}</td>
					<td class="profa" style="display: none;">
						<select class="w3-round-xlarge form-control" name="department" id="departoption">
	                    	<option selected>{{$edituser->department}}</option>
	                    </select>
					</td>
				</tr>
				<tr>
					<th>{{ __('Email') }}</th>
					<td>:</td>
					<td class="profb" style="display: block;">{{$edituser->email}}</td>
					<td class="profa" style="display: none;">
						<input name="email" input id="email" type="email" class="w3-round-xlarge form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$edituser->email}}">
	                    @if ($errors->has('email'))
	                        <span class="invalid-feedback">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
                    	@endif
					</td>
				</tr>
				<tr>
					<th>{{ __('Nomor Telepon') }}</th>
					<td>:</td>
					<td class="profb" style="display: block;">{{$edituser->phone}}</td>
					<td class="profa" style="display: none;">
						<input type="text" id="phone" class="w3-round-xlarge form-control" value="{{$edituser->phone}}" name="phone">
					</td>
				</tr>
				<tr>
					<th>{{ __('Role') }}</th>
					<td>:</td>
					<td class="profb" style="display: block;">{{$edituser->roleName()}}</td>
					<td class="profa" style="display: none">
						<select id="roleoption" class="w3-round-xlarge form-control" name="role" value="{{ old('faculty') }}" required>
	                    <option value="partisipan">Partisipan</option>
	                    <option value="admin">Admin</option>
	                    <option value="pustakawan">Pustakawan</option>
	                    </select>
					</td>
				</tr>
				</table>
				<button id="btnsubmit" class="profa editprofil btna" style="display: none;margin-left: 150px" type="submit" name="action"><i class="fa">&#xf1d8;</i> Simpan</button>
	    	</form>
				<a class="btn-link profb btna" onclick="document.getElementById('id01').style.display='block'">Daftar Jurnal</a>
	    		<button id="btncancel" style="position:absolute;display: none;bottom:0px;" class="profa editprofil btna" onclick="canceleditprofil()"><i class="fa">&#xf00d;</i> Batal</button>
				<button id="btnubah" style="display: block" class="profb editprofil btna" onclick="editprofil()"><i class="fa">&#xf044;</i> Sunting User</button>
		</div>
		<div class="col-sm-3"></div>
	</div>

	<div id="id01" class="w3-modal">
		<div class="w3-modal-content w3-animate-top" style="margin-top: -60px">
			<header class="w3-container w3-teal">
			  	<span onclick="document.getElementById('id01').style.display='none'" class="w3-hover-teal w3-button w3-display-topright">&times;</span>
			  	<h2>Daftar Jurnal {{$user->name}}</h2>
			</header>
			<div class="w3-container">
			    <form method="POST" action="/admin/user/edit/jurnal/{{$edituser->id}}">
			    	@csrf
			    	<div class="row">
			        <div class="listjurnal col-sm-6">
				        @foreach ($jurnal1 as $jur1)
				        	<input id="{{$jur1->id}}" class="w3-check" type="checkbox" name="{{$jur1->name}}" value="{{$jur1->name}}"> {{$jur1->fullName}}<br>
				        @endforeach
				    </div>
				   	<div class="listjurnal col-sm-6">
				       	 @foreach ($jurnal2 as $jur1)
				        	<input id="{{$jur1->id}}" class="w3-check" type="checkbox" name="{{$jur1->name}}" value="{{$jur1->name}}"> {{$jur1->fullName}}<br>
				        @endforeach
				   	</div>
					</div><br>
			      	<div style="margin-top: 10px">
				        <button class="w3-button w3-circle w3-red" style="height: 50px;width: 50px"><i class="fa fa-check w3-large"></i></button>
			      	</div>
	    		</form>
	    		<br>
	    	</div>
		</div>
	</div>


	<script type="text/javascript">
		// $('#iconified').on('keyup', function() {
		//     var input = $(this);
		//     if(input.val().length === 0) {
		//         input.addClass('empty');
		//     } else {
		//         input.removeClass('empty');
		//     }
		// });

		// $(document).ready(function(){
		// 	if(in)
		// });
		$(document).ready(function(){
			@foreach ($myJurnal as $takenjur)
				$('#'+'{{$takenjur->id}}').attr('checked','checked');
			@endforeach
		});

		var modal = document.getElementById('id01');
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}

		function editprofil(){
			$('.profb').css('display','none');
			$('.profa').css('display','block');
		}
		function canceleditprofil(){
			$('.profb').css('display','block');
			$('.profa').css('display','none');
		}

	    $(document).ready(function(){
	    	$('#facultyoption option[value="{{$edituser->faculty}}"]').prop('selected', 'selected');
			$('#roleoption option[value="{{$edituser->roleName()}}"]').prop('selected', 'selected');
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
