@extends('webpage.mastercourse')

@section('title')
  Prestest
@endsection()

@section('titlejurnal')
  Pretest
@endsection()

@section('howto')
ini pretest lo
@endsection()

@section('video')
ini pretest lo
@endsection()

@section('morescript')
  $(document).ready(function(){
    $("#2").addClass("active")
  });

  $(document).ready(function(){
    var temp={{$user->progress}};
    if(temp>=2){
      $("#nextbutton").css('display','block');
    }
    else{
        $("#accord1").click(function(){
            $("#nextbutton").fadeIn();
        });
    }
  });

  document.getElementById('vid1').addEventListener('ended',myHandler,false);
    function myHandler(e) {
      var temp={{$user->progress}};
    if(temp>=2){
      $("#nextbutton").css('display','block');
    }
    else{
          $("#nextbutton").fadeIn();
      }
    }
@endsection()
