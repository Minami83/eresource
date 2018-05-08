@extends('layouts.master')

@section('title')
  List User
@endsection

@section('style')
@endsection()

@section('isi')
<div class="row" style="margin-top: 100px">
  <div class="col-sm-3"></div>
    <div class="col-sm-6">
      <table class="w3-table">
        <tr>
          <th>NRP</th>
          <th>Nama</th>
        </tr>
        @foreach($userList as $ul)
        <tr>
          <td style="width: 200px">{{$ul->nrp}}</td>
          <td>{{$ul->name}}</td>
          <td><a href="/admin/user/detail/{{$user->id}}"><i class="fa fa-arrow-circle-right"></i></a></td>
        </tr>
        @endforeach
      </table>
    </div>
  <div class="col-sm-3"></div>
</div>

<script type="text/javascript">
</script>

@endsection()
