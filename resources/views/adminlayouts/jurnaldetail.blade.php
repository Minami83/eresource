@extends('layouts.master')
@section('title')
	{{$jurnal->name}}
@endsection()

@section('style')
	.editprofil{
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
	}

	th{
		width:140px;
	}
	.btna{
		width:130px;
		height:30px;
		margin-top:10px;
		margin-left:16px;
		cursor:pointer;
	}
@endsection()

@section('isi')

	<div class="w3-row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<br>
		    <form method="POST" action="/admin/jurnal/edit/{{$jurnal->id}}">
		    	@csrf
		    	<table class="w3-table">
				<tr>
					<th>{{ __('Nama Jurnal') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$jurnal->fullName}}</td>
					<td class="profa" style="display: none">
						<input id="fullName" type="text" class="w3-round-xlarge empty form-control" name="fullName" value="{{$jurnal->fullName}}" required autofocus>
                    </td>
				</tr>
				<tr>
					<th>{{ __('Alias') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$jurnal->name}}</td>
					<td class="profa" style="display: none">
						<input id="name" type="text" class="w3-round-xlarge empty form-control" name="name" value="{{$jurnal->name}}" required autofocus>
					</td>
				</tr>
				<tr>
					<th>{{ __('How to') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$jurnal->howto}}</td>
					<td class="profa" style="display: none">
						<input style="width:100%" type="file" accept="text/plain" value="{{$jurnal->howto}}" name="howto">
					</td>
				</tr>
				<tr>
					<th>{{ __('Video') }}</th>
					<td>:</td>
					<td class="profb" style="display: block">{{$jurnal->video}}</td>
					<td class="profa" style="display: none">
						<input style="width:100%" type="file" accept="video/mp4,video/x-m4v,video/*" name="video">
					</td>
				</tr>
				</table>
				<div class="profb" style="display: block;">
					<video width="100%" height="100%" controls id="vid1">
						<source id="myVid" src="{{$jurnal->video}}" type="video/mp4">
					</video>
				</div>
				<button id="btnsubmit" class="profa editprofil btna" style="display: none;margin-left: 130px" type="submit" name="action"><i class="fa">&#xf1d8;</i> Submit</button>	
	    	</form>
	    		<button id="btncancel" style="position:absolute;display: none;bottom:0px;" class="profa editprofil btna" onclick="canceleditprofil()"><i class="fa">&#xf00d;</i> Cancel</button>
	    		@if ($user->roleName()=='admin')
				<button id="btnubah" style="display: block" class="profb editprofil btna" onclick="editprofil()"><i class="fa">&#xf044;</i> Edit Test</button>
	    		@endif
		</div>
		<div class="col-sm-3"></div>
		<br>
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
		$(document).ready(function(){
			$('#jurnalnavbar').addClass('w3-text-amber');
			$('#jurnalnavbar').removeClass('w3-biru');
		});
		
		$(document).ready(function(){
			var temp = "{{$jurnal->video}}";
			var temp2 = temp.replace(/ /g, "%20");
			$("#myVid").attr('src',temp2);
		});
	</script>
@endsection()