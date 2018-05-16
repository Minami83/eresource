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
						<input id="newpass" type="text" class="w3-round-xlarge form-control" name="newpass" autofocus>
					</td>
				</tr>
				<tr>
					<th>{{ __('Confirm password') }}</th>
					<td>:</td>
					<td>
						<input id="password_confirmation" type="text" class="w3-round-xlarge form-control" name="password_confirmation" autofocus>
					</td>
				</tr>
				</table>
				<button id="btnsubmit" type="submit" name="action"><i class="fa">&#xf1d8;</i> Submit</button>
	    	</form>
		</div>
		<div class="col-sm-3"></div>
	</div>
@endsection
