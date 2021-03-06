@extends('layouts.master')

@section('title')
  List User
@endsection

@section('style')
  th{
    cursor:pointer;
  }
  .empty {
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
  }
  #myInput {
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 15px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
  }
  .menu{
    width:1%;
  }
@endsection()

@section('isi')
<div class="w3-row container">
  <div id="alertfail">
    {{ session('alert') }}
  </div>
  <div class="col-sm-11"><input class="empty iconified" type="text" id="myInput" onkeyup="myFunction()" placeholder="&#xf002;   Cari user.."></div>
  @if ($user->roleName()=='admin')
  <div class="col-sm-1" style="height:50px"><button style="width:100%;height:100%;" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-plus"></i></button></div>
  @endif
</div>

<div class="w3-row container w3-center" style="overflow: auto;">
  <div class="w3-responsive">
    <table id="myTable" class="w3-table">
      <tr>
        <div class="col-sm-1">
          <th onclick="sortTable(0)">ID <i class="fa">&#xf0dc;</i></th>
        </div>
        <div class="col-sm-1">
          <th onclick="sortTable(1)">Nama <i class="fa">&#xf0dc;</i></th>
        </div>
        <div class="col-sm-1">
          <th onclick="sortTable(2)">Status <i class="fa">&#xf0dc;</i></th>
        </div>
        <div class="col-sm-1">
          <th onclick="sortTable(3)">Role <i class="fa">&#xf0dc;</i></th>
        </div>
      </tr>
      @if (session('alert'))
          <script type="text/javascript">
            $("#alertfail").html('{{ session('alert') }}');
            $("#alertfail").attr('class','alert alert-danger');
          </script>
      @endif
      @foreach($userList as $ul)
      <tr>
        <div>
          <td class="tes">{{$ul->id_number}}</td>
          <td class="tes">{{$ul->name}}</td>
          <td class="tes">
            @if ($ul->verified==0)
              Belum terverifikasi
            @elseif($ul->verified==1)
              Sedang menjalankan course
            @else
              Selesai
            @endif
          </td>
          <td class="tes">
            @if ($ul->roleName()=='admin')
              Admin
            @elseif($ul->roleName()=='pustakawan')
              Pustakawan
            @else
              Partisipan
            @endif
          </td>
          <td class="menu">
            @if ($ul->roleName()=='partisipan')
              <a href="/admin/user/score/{{$ul->id}}"><button><i class="fa fa-file"></i></button></a>
            @endif
          </td>
          <td class="menu">
            @if($ul->verified>0 )
              <a href="/admin/user/detail/{{$ul->id}}">
            @else
              <a href="/admin">
            @endif
            <button><i class="fa fa-arrow-circle-right"></i></button></a>
          </td>
          <td class="menu">
            @if ($user->roleName()=='admin')
              <form method="POST" action="/admin/user/delete/{{$ul->id}}">
                @csrf
                {{method_field('DELETE')}}
                <button><i class="fa fa-close"></i></button>
              </form>
            @endif
          </td>
        </div>
      </tr>
      @endforeach
    </table>
  {{$userList->links()}}
  </div>
</div>

<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-animate-top" style="margin-top: -60px">
    <header class="w3-container w3-biru">
      <span onclick="document.getElementById('id01').style.display='none'"
      class="w3-hover-biru w3-button w3-display-topright">&times;</span>
      <h2>Tambah User</h2>
    </header>
    <div class="w3-container">
      <div class="w3-white w3-round-large">
      <br>
        <form method="POST" action="/admin/user/make">
          @csrf
            <div class="form-group">
              <input id="id_number" type="text" class="w3-round-xlarge iconified empty form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" placeholder="&#xf007;     {{ __('ID') }}" required autofocus>
              @if ($errors->has('id_number'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('id_number') }}</strong>
                  </span>
                  <script type="text/javascript">
                    $(document).ready(function(){
                      document.getElementById('id01').style.display="block"
                    });
                  </script>
              @endif
            </div>
            <div class="form-group">
              <input id="name" type="text" class="w3-round-xlarge iconified empty form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="&#xf2b9;    {{ __('Nama') }}" required autofocus>
              @if ($errors->has('name'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  <script type="text/javascript">
                    $(document).ready(function(){
                      document.getElementById('id01').style.display="block"
                    });
                  </script>
              @endif
            </div>
            <div class="form-group">
              <select class="w3-round-xlarge iconified empty form-control" name="faculty" id="facultyoption" value="{{ old('faculty') }}" required>
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
                  <script type="text/javascript">
                    $(document).ready(function(){
                      document.getElementById('id01').style.display="block"
                    });
                  </script>
              @endif
            </div>
            <div class="form-group">
              <select class="w3-round-xlarge iconified empty form-control" name="department" id="departoption" value="{{ old('department') }}" required>
                <option disabled="true" selected>-- Departemen --</option>
              </select>
              @if ($errors->has('department'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('department') }}</strong>
                  </span>
                  <script type="text/javascript">
                    $(document).ready(function(){
                      document.getElementById('id01').style.display="block"
                    });
                  </script>
              @endif
            </div>
            <div class="form-group">
              <input name="email" input id="email" type="email" class="w3-round-xlarge iconified empty form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="&#xf0e0;   {{ __('Email') }}" required>
              @if ($errors->has('email'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  <script type="text/javascript">
                    $(document).ready(function(){
                      document.getElementById('id01').style.display="block"
                    });
                  </script>
              @endif
            </div>
            <div class="form-group">
              <input type="text" id="phone" class="w3-round-xlarge iconified empty form-control" value="{{ old('phone') }}" name="phone" placeholder="&#xf095;    {{ __('Nomor Telepon') }}" required>
              @if ($errors->has('phone'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                <script type="text/javascript">
                  $(document).ready(function(){
                    document.getElementById('id01').style.display="block"
                  });
                </script>
              @endif
            </div>
            <div class="form-group">
              <select class="w3-round-xlarge iconified empty form-control" name="role" value="{{ old('faculty') }}" required>
                <option value="partisipan">Partisipan</option>
                <option value="admin">Admin</option>
                <option value="pustakawan">Pustakawan</option>
              </select>
            </div>

            <div class="form-group">
                <input id="password" type="password" class="w3-round-xlarge iconified empty form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="&#xf023;    {{ __('Password') }}" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    <script type="text/javascript">
                          $(document).ready(function(){
                            document.getElementById('id01').style.display="block"
                          });
                        </script>
                @endif
            </div>

            <div class="form-group">
                <input id="password-confirm" type="password" class="w3-round-xlarge iconified empty form-control" name="password_confirmation" placeholder="&#xf01e;   {{ __('Confirm Password') }}" required>
            </div>
            <button style="width: 100%" class="btn waves-effect waves-light" type="submit" name="action">Confirm
            </button><br><br>
        </form>
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var modal = document.getElementById('id01');
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
  $(window).ready(function(){
      if ($(window).width() >= 992) {
        $('#myTable').css("width","100%");
      }
      else if($(window).width() < 992){
        $('#myTable').css("width",$(window).width()-11);
      }
  });
  $(window).resize(function(){
      if ($(window).width() >= 992) {
        $('#myTable').css("width","100%");
      }
      else if($(window).width() < 992){
        $('#myTable').css("width",$(window).width()-11);
      }
  });
  function myFunction() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td1 = tr[i].getElementsByTagName("td")[0];
      td2 = tr[i].getElementsByTagName("td")[1];
      if (td1 || td2) {
        if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }

  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    dir = "asc";
    while (switching) {
      switching = false;
      rows = table.getElementsByTagName("TR");
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch= true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch= true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount ++;
      } else {
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }

  $('#iconified').on('keyup', function() {
        var input = $(this);
        if(input.val().length === 0) {
            input.addClass('empty');
        } else {
            input.removeClass('empty');
        }
    });

  $(document).ready(function(){
    $('#usernavbar').addClass('w3-text-amber');
    $('#usernavbar').removeClass('w3-biru');
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
