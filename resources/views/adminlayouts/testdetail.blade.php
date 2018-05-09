 @extends('layouts.master')
@section('title')
	Question {{$test->id}}
@endsection()

@section('style')
	{{-- .empty {
		border: none;
		border-color: transparent;
		border-bottom:1px solid black;
	} --}}

	.editprofil{
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
	}

	th{
		width:170px;	
	}
	.btna{
		width:110px;
		height:30px
	}
@endsection()

@section('isi')
	
	<div class="w3-row" style="margin-top: 70px">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 w3-white w3-round-large">
			<br>
		    <form method="POST" action="/admin/test/edit/{{$test->id}}">
		    	@csrf
		    	<table class="w3-table">
				<tr>
					<th>{{ __('Pertanyaan') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$test->question}}</td>
					<td class="profa" style="display: none">
						<input id="question" type="text" class="w3-round-xlarge empty form-control" name="fullName" value="{{$test->question}}" required autofocus>
                    </td>
				</tr>
				<tr>
					<th>{{ __('Pilihan 1') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$test->choice_1}}</td>
					<td class="profa" style="display: none">
						<input id="name" type="text" class="w3-round-xlarge empty form-control" name="choice_1" value="{{$test->choice_1}}" required autofocus>
					</td>
				</tr>
				<tr>
					<th>{{ __('Pilihan 2') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$test->choice_2}}</td>
					<td class="profa" style="display: none">
						<input id="name" type="text" class="w3-round-xlarge empty form-control" name="choice_2" value="{{$test->choice_2}}" required autofocus>
					</td>
				</tr>
				<tr>
					<th>{{ __('Pilihan 3') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$test->choice_3}}</td>
					<td class="profa" style="display: none">
						<input id="name" type="text" class="w3-round-xlarge empty form-control" name="choice_3" value="{{$test->choice_3}}" required autofocus>
					</td>
				</tr>
				<tr>
					<th>{{ __('Pilihan 4') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$test->choice_4}}</td>
					<td class="profa" style="display: none">
						<input id="name" type="text" class="w3-round-xlarge empty form-control" name="choice_4" value="{{$test->choice_4}}" required autofocus>
					</td>
				</tr>
				{{-- <tr>
					<th>{{ __('Jawaban') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$test->answer}}</td>
					<td class="profa" style="display: none">
						<input id="name" type="text" class="w3-round-xlarge empty form-control" name="answer" value="{{$test->answer}}" required autofocus>
					</td>
				</tr> --}}
				</table>
				<button id="btnsubmit" class="profa editprofil btna" style="display: none;margin-left: 100px" type="submit" name="action">Submit <i class="fa">&#xf1d8;</i></button>	
	    	</form>
	    		<button id="btncancel" style="position:absolute;display: none;bottom:0px;" class="profa editprofil btna" onclick="canceleditprofil()">Cancel <i class="fa">&#xf00d;</i></button>
				<button id="btnubah" style="display: block" class="profb editprofil btna" onclick="editprofil()">Edit Test <i class="fa">&#xf044;</i></button>
		</div>
		<div class="col-sm-3"></div>
	</div>

	<script type="text/javascript">

		function editprofil(){
			$('.profb').css('display','none');
			$('.profa').css('display','block');
		}
		function canceleditprofil(){
			$('.profb').css('display','block');
			$('.profa').css('display','none');
		}
	</script>
@endsection()