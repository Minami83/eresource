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
<div class="row" style="margin-top: 100px">
  <div class="col-sm-3"></div>
    <div class="col-sm-6 w3-center">
      <div class="col-sm-11"><input class="empty iconified" type="text" id="myInput" onkeyup="myFunction()" placeholder="&#xf002; Search for journals.."></div>
      <div class="col-sm-1"><button class="w3-right" style="width:50px;height:50px;" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-plus"></i></button></div>
      <table id="myTable" class="w3-table">
        <tr>
          <th onclick="sortTable(0)">ID <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(1)">Jurnal <i class="fa">&#xf0dc;</i></th>
        </tr>
        @foreach($jurnal as $jur)
        <tr>
          <td style="width: 75px">{{$jur->id}}</td>
          <td>{{$jur->fullName}}</td>
          <td style="width: 30px"><a href="/admin/jurnal/detail/{{$jur->id}}">
            <button><i class="fa fa-arrow-circle-right"></i></button>
          </td>
          <td style="width: 30px">
            <form method="POST" action="/admin/jurnal/delete/{{$jur->id}}">
              @csrf
              {{method_field('DELETE')}}
              <button><i class="fa fa-close"></i></a></td></button>
            </form>
        </tr>
        @endforeach
      </table>
    </div>
  <div class="col-sm-3"></div>
</div>

<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-animate-top" style="margin-top: -60px">
    <header class="w3-container w3-teal">
      <span onclick="document.getElementById('id01').style.display='none'"
      class="w3-button w3-hover-teal w3-display-topright">&times;</span>
      <h2>Add Journal</h2>
    </header>
    <div class="w3-container">
      <div class="w3-white w3-round-large">
      <br>
        <form method="POST" action="/admin/jurnal/make" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <input id="fullName" type="text" class="w3-round-xlarge iconified empty form-control" name="fullName" placeholder="&#xf007;     {{ __('Nama Jurnal') }}" required autofocus>
            </div>
            <div class="form-group">
                <input id="name" type="text" class="w3-round-xlarge iconified empty form-control" name="name" placeholder="&#xf2b9;    {{ __('Alias') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>How to:</label>
                <input type="file" accept="text/plain" name="howto">
            </div>
            <div class="form-group">
              <label>Video:</label>
                <input type="file" accept="video/mp4,video/x-m4v,video/*" name="video">
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
