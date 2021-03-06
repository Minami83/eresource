@extends('layouts.master2')
@section('title')
    Register
@endsection()

@section('style')
    body{
        color:#ffc107!important;
        background-color: #00748d!important;
    }

    .text{
        color:white;
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
    }
    .text:nth-child(-n+2){
        color:black;
    }

    #verline1{
        height: 630px;
    }
    #verline2{
        border-left: 1px solid white;
        min-height: 630px;
    }
@endsection()

@section('isi')
    <div class="container" style="margin-top: 15px;margin-bottom: 15px">
        <div style" class="col-sm-6" id="verline1">
            <div style="margin-top: 175px; margin-bottom: 175px">
                <div class="tester123 w3-center">
                    <img src="/image/eresourcelogo.png" style="width: 300px">
                </div><br>
                <div class="col-sm-2"></div>
                <div class="col-sm-10 text">
                    <p>Pengenalan e-resources ITS</p>
                    <p>Pengenalan ITS digital repository</p>
                    <p>Cara mengakses dan memanfaatkan e-journal</p>
                    <p>Cara mengakses dan memanfaatkan ITS digital repository</p>
                </div>
            </div>
        </div>
    
        <div class="col-sm-6" id="verline2">
            <div class="col-sm-1"></div>
            <div style="margin-top: 13.5px;margin-bottom: 13.5px" id="tes" class="col-sm-10 w3-card w3-white w3-round-large"><br>
                <h1 class="text w3-center">Register</h1><br>    
                <form style="height: 500px;" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input id="id_number" type="text" class="w3-round-xlarge iconified text form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" placeholder="&#xf007;     {{ __('ID') }}" required autofocus>
                    @if ($errors->has('id_number'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('id_number') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="name" type="text" class="w3-round-xlarge iconified text form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="&#xf2b9;    {{ __('Nama') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <select class="w3-round-xlarge iconified text form-control" name="faculty" id="facultyoption" value="{{ old('faculty') }}" required>
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
                    @if ($errors->has('faculty'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('faculty') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <select class="w3-round-xlarge iconified text form-control" name="department" value="{{ old('department') }}" id="departoption" required>
                        <option disabled="true" selected>-- Departemen --</option>
                    </select>
                    @if ($errors->has('department'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('department') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input name="email" input id="email" type="email" class="w3-round-xlarge iconified text form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="&#xf0e0;   {{ __('Email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" id="phone" class="w3-round-xlarge iconified text form-control" value="{{ old('phone') }}" name="phone" placeholder="&#xf095;    {{ __('Nomor Telepon') }}" required>
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="w3-round-xlarge iconified text form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="&#xf023;    {{ __('Password') }}" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="w3-round-xlarge iconified text form-control" name="password_confirmation" placeholder="&#xf01e;   {{ __('Confirm Password') }}" required>
                </div>
                <button style="width: 100%" class="btn waves-effect waves-light" type="submit" name="action">Register
                </button><br><br>
                <p class="">Already have an account? <a class="btn-link" href="/login"><i>Login</i></a></p>
            </form>
            </div>
        </div>

    <script type="text/javascript">
        $('#iconified').on('keyup', function() {
            var input = $(this);
            if(input.val().length === 0) {
                input.addClass('text');
            } else {
                input.removeClass('text');
            }
        });

        $(document).ready(function(){
            var panel = document.getElementById('tes');
            if (panel.style.maxHeight){
              panel.style.maxHeight = null;
            } else {
              panel.style.height = panel.scrollHeight + "px";
            }
        });

        $(window).ready(function(){
                if ($(window).width() >= 992) {
                    $('#verline1').css("display","block");
                    $('#verline2').css("border-left","1px solid white");
                }
                else if($(window).width() < 992){
                    $('#verline1').css("display","none");
                    $('#verline2').css("border-left","none");
                }
        });
        $(window).resize(function(){
                if ($(window).width() >= 992) {
                    $('#verline1').css("display","block");
                    $('#verline2').css("border-left","1px solid white");
                }
                else if($(window).width() < 992){
                    $('#verline1').css("display","none");
                    $('#verline2').css("border-left","none");
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