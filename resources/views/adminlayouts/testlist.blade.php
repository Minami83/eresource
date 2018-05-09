@extends('layouts.master')

@section('title')
  List Test
@endsection

@section('style')
  p:nth-child(odd){
    background-color: #f2f2f2;
  }

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
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
  }
@endsection()

@section('isi')
<div class="row" style="margin-top: 100px">
  <div class="col-sm-2"></div>
    <div class="col-sm-8 w3-center">
      <div class="col-sm-10"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for journals.."></div>
      <div class="col-sm-2"><button style="width:50px;height:50px;" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-plus"></i></button></div>
      <table id="myTable" class="w3-table">
        <tr>
          <th onclick="sortTable(0)"># <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(1)">Soal <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(2)">Jawaban <i class="fa">&#xf0dc;</i></th>
        </tr>
        @foreach($test as $tes)
        <tr>
          <td style="width: 60px">{{$tes->id}}</td>
          <td>{{$tes->question}}</td>
          <td>
              <p>{{$tes->choice_1}}</p>
              <p>{{$tes->choice_2}}</p>
              <p>{{$tes->choice_3}}</p>
              <p>{{$tes->choice_4}}</p>
          </td>
          <td style="width: 30px"><a href="/admin/test/detail/{{$tes->id}}">
            <button><i class="fa fa-arrow-circle-right"></i></button>
          </td>
          <td style="width: 30px">
            <form method="POST" action="/admin/test/delete/{{$tes->id}}">
              @csrf
              {{method_field('DELETE')}}
              <button><i class="fa fa-close"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  <div class="col-sm-3"></div>
</div>

<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-animate-top" style="margin-top: 0px">
    <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('id01').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h2>Add Question</h2>
    </header>
    <div class="w3-container">
      <div class="w3-white w3-round-large">
      <br>
        <form method="POST" action="/admin/test/make">
          @csrf
            <div class="form-group">
                <input id="question" type="text" class="w3-round-xlarge iconified empty form-control" name="fullName" placeholder="&#xf128;     {{ __('Pertanyaan') }}" required autofocus>
            </div>
            {{-- <div class="form-group">
                <input id="answer" type="text" class="w3-round-xlarge iconified empty form-control" name="answer" placeholder="&#xf00c;    {{ __('Jawaban') }}" required autofocus>
            </div> --}}
            <div class="form-group">
                <input id="choice_1" type="text" class="w3-round-xlarge iconified empty form-control" name="choice_1" placeholder="&#xf00c;    {{ __('Pilihan 1') }}" required autofocus>
            </div>
            <div class="form-group">
                <input id="choice_2" type="text" class="w3-round-xlarge iconified empty form-control" name="choice_2" placeholder="&#xf00c;    {{ __('Pilihan 2') }}" required autofocus>
            </div>
            <div class="form-group">
                <input id="choice_3" type="text" class="w3-round-xlarge iconified empty form-control" name="choice_3" placeholder="&#xf00c;    {{ __('Pilihan 3') }}" required autofocus>
            </div>
            <div class="form-group">
                <input id="choice_4" type="text" class="w3-round-xlarge iconified empty form-control" name="choice_4" placeholder="&#xf00c;    {{ __('Pilihan 4') }}" required autofocus>
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

  function myFunction() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td1 = tr[i].getElementsByTagName("td")[0];
      td2 = tr[i].getElementsByTagName("td")[1];
      td3 = tr[i].getElementsByTagName("td")[2];
      if (td1 || td2 || td3) {
        if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
