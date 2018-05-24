@extends('layouts.master')

@section('title','Verifikasi User')

@section('style')
  .active {
      color: #ffc410;
  }

  .accordion {
    background-color:white;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
      transition: 0.4s;
  }

  .accordion:after {
      content: '\002B';
      color: #777;
      font-weight: bold;
      float: right;
      margin-left: 5px;
  }

  .active2:after{
    content: '\2212';
  }

  .panel {
    font-size:12px;
      padding: 0 18px;
      background-color: white;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.2s ease-out;
  }

@endsection()
@section('isi')
<div class="container">
  <div class="row">
  <div class="col-sm-2"></div>
    <div class="col-sm-8 w3-center">
      <div id="alertfail">
        {{ session('alert') }}
      </div>
    </div>
  </div>
@if (session('alert'))
  <script type="text/javascript">
    $("#alertfail").html('{{ session('alert') }}');
    $("#alertfail").attr('class','alert alert-danger');
  </script>
@endif
@foreach($unverified as $verif)
  <button class="accordion" id="{{$verif->id}}" onclick="accordionfunc(this.id)">{{$verif->name}}</button>
  <div class="panel">
    <form method="post" action="/admin">
      @csrf
      <input type='hidden' name='email' value={{$verif->email}}>
      <div class="row">
        <div class="col-sm-6">
          <input id="selectall" class="w3-check" type="checkbox" name="selectall" value=""> Select All<br>
          @foreach($jurnal1 as $jur)
          <input class="w3-check check" type="checkbox" name={{$jur->name}} value={{$jur->name}}> {{$jur->fullName}}<br>
          @endforeach
      </div>
      <div class="col-sm-6">
          @foreach($jurnal2 as $jur)
          <input class="w3-check check" type="checkbox" name={{$jur->name}} value={{$jur->name}}> {{$jur->fullName}}<br>
          @endforeach
      </div>
      </div><br>
      <div style="margin-top: 10px">
        <button class="w3-button w3-circle w3-red" style="height: 50px;width: 50px"><i class="fa fa-check w3-large"></i></button>
      </div>
    </form>
  </div>
@endforeach
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#verifikasinavbar').addClass('w3-text-amber');
    $('#verifikasinavbar').removeClass('w3-biru');
  });


  $("#selectall").change(function(){  //"select all" change 
        $(".check").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });
  $('.check').change(function(){ 
      //uncheck "select all", if one of the listed checkbox item is unchecked
      if(false == $(this).prop("checked")){ //if this item is unchecked
          $("#selectall").prop('checked', false); //change "select all" checked status to false
      }
      //check "select all" if all checkbox items are checked
      if ($('.check:checked').length == $('.check').length ){
          $("#selectall").prop('checked', true);
      }
  });

  function accordionfunc(accordid){
    var accord=document.getElementById(accordid);
      accord.classList.toggle("active2");
      var panel = accord.nextElementSibling;
      if (panel.style.maxHeight){
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + 100 + "px";
      }
  }
</script>

@endsection()
