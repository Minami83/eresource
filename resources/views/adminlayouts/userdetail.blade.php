 @extends('layouts.master')
@section('title')
	{{$user->name}}
@endsection()

@section('style')
	.empty {
		border: none;
		border-color: transparent;
		border-bottom:1px solid black;
	}

	.editprofil{
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
	}

	th{
		width:200px;
	}

@endsection()

@section('isi')
	
	<div class="w3-row" style="margin-top: 140px">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 w3-white w3-round-large">
	    	<table class="w3-table">
			<tr>
				<th>{{ __('NRP') }}</th>
				<td>: {{$user->nrp}}</td>
			</tr>
			<tr>
				<th>{{ __('Nama') }}</th>
				<td>: {{$user->name}}</td>
			</tr>
			<tr>
				<th>{{ __('Fakultas') }}</th>
				<td>: {{$user->faculty}}</td>
			</tr>
			<tr>
				<th>{{ __('Departemen') }}</th>
				<td>: {{$user->department}}</td>
			</tr>
			<tr>
				<th>{{ __('Email') }}</th>
				<td>: {{$user->email}}</td>
			</tr>
			<tr>
				<th>{{ __('Nomor Telepon') }}</th>
				<td>: {{$user->phone}}</td>
			</tr>
			</table>
		</div>
		<div class="col-sm-3"></div>
	</div>

	<script type="text/javascript">
	</script>
@endsection()