@extends('layouts.master')

@section('title','Change Password')

@section('isi')
	<div class="w3-row" style="margin-top: 70px">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 w3-white w3-round-large">
			<br>
		    <form method="POST" action="/profile/password">
		    	@csrf
		    	<table class="w3-table">
				<tr>
					<th>{{ __('Old password') }}</th>
					<td>:</td>
					<td>
						<input id="oldpass" type="password" class="w3-round-xlarge form-control" name="oldpass" autofocus>
                    </td>
				</tr>
				<tr>
					<th>{{ __('New password') }}</th>
					<td>:</td>
					<td>
						<input id="newpass" type="password" class="w3-round-xlarge form-control" name="newpass" autofocus>
					</td>
				</tr>
				<tr>
					<th>{{ __('Confirm password') }}</th>
					<td>:</td>
					<td>
						<input id="password_confirmation" type="password" class="w3-round-xlarge form-control" name="password_confirmation" autofocus>
					</td>
				</tr>
				</table>
				<button style="width:110px;height:30px;margin-top:10px;margin-left:16px;" id="btnsubmit" type="submit" name="action"><i class="fa">&#xf1d8;</i> Submit</button>
	    	</form>
		</div>
		<div class="col-sm-3"></div>
	</div>

	{{-- <script type="text/javascript">
		function validate(form){
			@php
        		$data = $request->all();
			@endphp
			@if (!(Hash::check($data['oldpass'],$user->password)))
				alert('wrong old password');
			@else if($data['newpass'] != $data['password_confirmation'])
				alert('password confirmation does not match');
			@else

			@endif
		}
	</script> --}}
@endsection
