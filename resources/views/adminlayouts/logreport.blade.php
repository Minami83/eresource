@extends('layouts.master')

@section('title','Log')

@section('style')
	th{
		cursor:pointer;
	}
  	.w3-table{
  		width:70%;
	    margin-left:15%;
	    margin-right:15%;
	}
@endsection()

@section('isi')

	<div class="col-sm-12">
		 <div class="row">
		 	<div class="w3-responsive w3-center">
		 		<table id="myTable" class="w3-table w3-bordered">
					<tr>
						<th>#</th>
						<th onclick="sortTable(1)" style="min-width: 150px">Nama User <i class="fa">&#xf0dc;</i></th>
						<th onclick="sortTable(2)">Posisi <i class="fa">&#xf0dc;</i></th>
						<th onclick="sortTable(3)">Kegiatan <i class="fa">&#xf0dc;</i></th>
					</tr>
					@foreach($logReport as $log)
					<tr>
						<td>{{$log->id}}</td>
						<td>{{$log->userName()}}</td>
						<td>{{$log->jurnalName()}}</td>
						<td>{{$log->activity}}</td>
					</tr>
					@endforeach
				</table>
				{{$logReport->links()}}
			</div>
		</div><br><br>
	</div>

	<script type="text/javascript">

		$(document).ready(function(){
			$('#lognavbar').addClass('w3-text-amber');
			$('#lognavbar').removeClass('w3-biru');
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

@endsection
