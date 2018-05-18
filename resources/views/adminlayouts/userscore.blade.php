@extends('layouts.master')

@section('title')
  Skor {{$showeduser->name}}
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
<div class="row" style="margin-top: 100px">
  <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <h1>{{$showeduser->name}}</h1><br>
      <h5 id="preskor">PreTest : </h5>
      <h5 id="postskor">PostTest : </h5>
      <table id="myTable" class="w3-table">
        <tr>
          <th onclick="sortTable(0)"># <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(1)">Soal <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(3)">Pretes <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(4)">Posttes <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(2)">Jawaban <i class="fa">&#xf0dc;</i></th>
        </tr>
        @foreach($test as $tes)
        <tr>
          <td style="width: 60px">{{$tes->id}}</td>
          <td>{{$tes->question}}</td>
          <td>{{$preAns[$tes->id-1]->answer}}</td>
          <td>{{$postAns[$tes->id-1]->answer}}</td>
          <td class="kumpulanans">
              {{-- <p id="ans1">{{$tes->choice_1}}</p>
              <p id="ans2">{{$tes->choice_2}}</p>
              <p id="ans3">{{$tes->choice_3}}</p>
              <p id="ans4">{{$tes->choice_4}}</p> --}}
              {{$truAns[$tes->id-1]}}
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  <div class="col-sm-3"></div>
</div>

<script type="text/javascript">
  var modal = document.getElementById('id01');
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }

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

  $(document).ready(function(){
	@php
		$temp1=sizeof($test);
	@endphp
	preskor=({{$preScore}})/{{$temp1}}*100;
	postskor=({{$postScore}})/{{$temp1}}*100;
	$('#preskor').append(preskor);
	$('#postskor').append(postskor);
  });

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
