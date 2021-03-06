@extends('layouts.master')

@section('title')
  Skor
@endsection

@section('style')
  th{
    cursor:pointer;
  }
@endsection()

@section('isi')
<div class="col-sm-12">
  <div class="row container">
    <h3 id="preskor">PreTest : </h3>
    <h3 id="postskor">PostTest : </h3>
    <br>
  </div>

  <div class="row">
    <div class="w3-responsive">
      <table id="myTable" class="w3-table w3-bordered">
        <tr>
          <th onclick="sortTable(0)"># <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(1)">Soal <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(3)">Pretes <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(4)">Posttes <i class="fa">&#xf0dc;</i></th>
          <th onclick="sortTable(2)">Jawaban <i class="fa">&#xf0dc;</i></th>
        </tr>
        @foreach($test as $tes)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$tes->question}}</td>
          <td>{{$preAns[$loop->iteration-1]->answer}}</td>
          <td>{{$postAns[$loop->iteration-1]->answer}}</td>
          <td class="kumpulanans">
              {{$truAns[$loop->iteration-1]}}
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">

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

</script>

@endsection()
