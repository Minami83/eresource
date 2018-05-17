@extends('layouts.master')

@section('title','Skor')

@section('isi')
	<div class="row" style="margin-top: 100px">
	  <div class="col-sm-3"></div>
	    <div class="col-sm-6 w3-center">
	      <div class="col-sm-11"><input class="empty iconified" type="text" id="myInput" onkeyup="myFunction()" placeholder="&#xf002; Search for names.."></div>
	      <div class="col-sm-1"><button class="w3-right" style="width:50px;height:50px;" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-plus"></i></button></div>
	      <table id="myTable" class="w3-table">
	        <tr>
	          <th onclick="sortTable(0)">ID <i class="fa">&#xf0dc;</i></th>
	          <th onclick="sortTable(1)">Nama <i class="fa">&#xf0dc;</i></th>
	          <th onclick="sortTable(2)">Status <i class="fa">&#xf0dc;</i></th>
	        </tr>
	        @foreach($userList as $ul)
	        <tr>
	          <td style="width: 200px">{{$ul->id_number}}</td>
	          <td>{{$ul->name}}</td>
	          <td>
	            @if ($ul->verified==0)
	              Belum terverifikasi
	            @elseif($ul->verified==1)
	              Sedang menjalankan course
	            @else
	              Selesai
	            @endif
	          </td>
	          <td style="width: 30px">
	            @if($ul->verified>0 )
	            <a href="/admin/user/detail/{{$ul->id}}">
	            @else
	            <a href="/admin">
	            @endif
	            <button><i class="fa fa-arrow-circle-right"></i></button>
	          </td>
	          <td style="width: 30px">
	            <form method="POST" action="/admin/user/delete/{{$ul->id}}">
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
@endsection()