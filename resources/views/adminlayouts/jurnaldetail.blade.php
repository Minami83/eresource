 @extends('layouts.master')
@section('title')
	{{$jurnal->name}}
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
						<textarea class="empty" style="width:100%;height: 200px" name="howto">{{$jurnal->howto}}</textarea>
					</td>
				</tr>
				<tr>
					<th>{{ __('Video') }}</th>
					<td>:</td>
					<td class="profb" style="display: block;">
						<video width="320" height="240" controls id="vid1">
							<source src="{{$jurnal->howto}}" type="video/mp4">
						</video>
					</td>
					<td class="profa" style="display: none;">
						<input type="file" accept="video/mp4,video/x-m4v,video/*" name="video">
					</td>
				</tr>
				{{-- <tr>
					<th>{{ __('Tutorial') }}</th>
					<td class="profb" style="display: block;">{{$jurnal->tutorial}}</td>
					<td class="profa" style="display: none;">
						<textarea class="empty" style="width:100%;height: 200px" name="tutorial" placeholder="Step-by-step Journal"></textarea>
					</td>
				</tr> --}}
				</table>
				<button id="btnsubmit" class="profa editprofil btna" style="display: none;margin-left: 100px" type="submit" name="action">Submit <i class="fa">&#xf1d8;</i></button>	
	    	</form>
	    		<button id="btncancel" style="position:absolute;display: none;bottom:0px;" class="profa editprofil btna" onclick="canceleditprofil()">Cancel <i class="fa">&#xf00d;</i></button>
				<button id="btnubah" style="display: block" class="profb editprofil btna" onclick="editprofil()">Edit Jurnal <i class="fa">&#xf044;</i></button>
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