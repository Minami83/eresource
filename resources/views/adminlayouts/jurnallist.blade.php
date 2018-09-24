@extends('layouts.master')

@section('title')
  List Jurnal
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
@endsection()

@section('isi')
<div class="w3-row container">
  <div id="alertfail">
    {{ session('alert') }}
  </div>
  <div class="col-sm-11"><input class="empty iconified" type="text" id="myInput" onkeyup="myFunction()" placeholder="&#xf002;   Cari jurnal.."></div>
  @if ($user->roleName()=='admin')
  <div class="col-sm-1" style="height: 50px"><button style="height:100%;width: 100%" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-plus"></i></button></div>
  @endif
</div>

<div class="w3-row container w3-center" style="overflow: auto;">
  <div class="w3-responsive">
    <table id="myTable" class="w3-table">
      <tr>
        <th></th>
        <th onclick="sortTable(1)">Jurnal <i class="fa">&#xf0dc;</i></th>
      </tr>
      @if (session('alert'))
      <script type="text/javascript">
        $("#alertfail").html('{{ session('alert') }}');
        $("#alertfail").attr('class','alert alert-danger');
      </script>
      @endif
      @foreach($jurnal as $jur)
      <tr>
        <td style="width: 75px">{{$loop->iteration}}</td>
        <td>{{$jur->fullName}}</td>
        <td style="width: 30px"><a href="/admin/jurnal/detail/{{$jur->id}}">
          <button><i class="fa fa-arrow-circle-right"></i></button>
        </td>
        <td style="width: 30px">
        @if ($user->roleName()=='admin')
          <form method="POST" action="/admin/jurnal/delete/{{$jur->id}}">
            @csrf
            {{method_field('DELETE')}}
            <button><i class="fa fa-close"></i></button>
          </form>
        @endif
        </td>
      </tr>
      @endforeach
    </table>
    {{$jurnal->links()}}
  </div>
</div>

<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-animate-top">
    <header class="w3-container w3-biru">
      <span onclick="document.getElementById('id01').style.display='none'"
      class="w3-button w3-hover-biru w3-display-topright">&times;</span>
      <h2>Tambah Jurnal</h2>
    </header>
    <div class="w3-container">
      <div class="w3-white w3-round-large">
      <br>
        <form method="POST" action="/admin/jurnal/make" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <input id="fullName" type="text" class="w3-round-xlarge iconified empty form-control" name="fullName" placeholder="&#xf007;     {{ __('Nama Jurnal') }}" required autofocus>
                @if ($errors->has('fullName'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('fullName') }}</strong>
                </span>
                <script type="text/javascript">
                  $(document).ready(function(){
                    document.getElementById('id01').style.display="block"
                  });
                </script>
                @endif
            </div>
            <div class="form-group">
                <input id="name" type="text" class="w3-round-xlarge iconified empty form-control" name="name" placeholder="&#xf2b9;    {{ __('Alias') }}" required autofocus>
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
                <label>How to:</label>
                <input type="file" accept="text/plain" name="howto" required>
            </div>
            <div class="form-group">
              <label>Video:</label>
                <input type="file" accept="video/mp4,video/x-m4v,video/*" name="video" required>
            </div>
            <!-- <div class="form-group">
                <label>Tutorial:</label>
                <textarea class="empty" style="width:100%;height: 200px" name="tutorial" placeholder="Step-by-step Journal"></textarea>
            </div> -->
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

  $(document).ready(function(){
    $('#jurnalnavbar').addClass('w3-text-amber');
    $('#jurnalnavbar').removeClass('w3-biru');
  });

  $('#iconified').on('keyup', function() {
        var input = $(this);
        if(input.val().length === 0) {
            input.addClass('empty');
        } else {
            input.removeClass('empty');
        }
    });

</script>

@endsection()
