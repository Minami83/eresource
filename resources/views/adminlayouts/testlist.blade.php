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
  <div class="col-sm-11"><input class="empty iconified" type="text" id="myInput" onkeyup="myFunction()" placeholder="&#xf002;   Cari soal.."></div>
  @if ($user->roleName()=='admin')
  <div class="col-sm-1" style="height:50px"><button style="width:100%;height:100%;" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-plus"></i></button></div>
  @endif
</div>

<div class="w3-row container w3-center" style="overflow: auto;">
  <div class="w3-resposive">
    <table id="myTable" class="w3-table">
      <tr>
        <th></th>
        <th onclick="sortTable(1)">Soal <i class="fa">&#xf0dc;</i></th>
        <th>Jawaban</th>
      </tr>
      @foreach($test as $tes)
      <tr>
        <td style="width: 60px">{{$loop->iteration}}</td>
        <td>{{$tes->question}}</td>
        <td class="kumpulanans">
            <p id="ans1">{{$tes->choice_1}}</p>
            <p id="ans2">{{$tes->choice_2}}</p>
            <p id="ans3">{{$tes->choice_3}}</p>
            <p id="ans4">{{$tes->choice_4}}</p>
        </td>
        <td style="width: 30px"><a href="/admin/test/detail/{{$tes->id}}">
          <button><i class="fa fa-arrow-circle-right"></i></button></a>
        </td>
        @if ($user->roleName()=='admin')
        <td style="width: 30px">
          <form method="POST" action="/admin/test/delete/{{$tes->id}}">
            @csrf
            {{method_field('DELETE')}}
            <button><i class="fa fa-close"></i></button>
          </form>
        </td>
        @endif
      </tr>
      @endforeach
    </table>
    {{$test->links()}}
  </div>
</div>

<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-animate-top" style="margin-top: 0px">
    <header class="w3-container w3-biru">
      <span onclick="document.getElementById('id01').style.display='none'"
      class="w3-hover-biru w3-button w3-display-topright">&times;</span>
      <h2>Tambah Pertanyaan</h2>
    </header>
    <div class="w3-container">
      <div class="w3-white w3-round-large">
      <br>
        <form method="POST" action="/admin/test/make">
          @csrf
            <div class="form-group">
                <input id="question" type="text" class="w3-round-xlarge iconified empty form-control" name="question" placeholder="&#xf128;     {{ __('Pertanyaan') }}" required autofocus>
            </div>
            <div class="form-group">
                <input id="answer" type="text" class="w3-round-xlarge iconified empty form-control" name="right_answer" placeholder="&#xf00c;    {{ __('Jawaban') }}" required autofocus>
                @if ($errors->has('right_answer'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('right_answer') }}</strong>
                </span>
                <script type="text/javascript">
                  $(document).ready(function(){
                    document.getElementById('id01').style.display="block"
                  });
                </script>
                @endif
            </div>
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

  $(document).ready(function(){
    $('#testnavbar').addClass('w3-text-amber');
    $('#testnavbar').removeClass('w3-biru');
  });
    
  $(document).ready(function(){
    var i=0
    @foreach ($test as $tes)
    var temp="{{$tes->right_answer}}";
    var header = document.getElementById("myTable");
    var p = header.getElementsByTagName("P");
    p[temp-1+i].style.color = "red";
    i+=4
    @endforeach
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
