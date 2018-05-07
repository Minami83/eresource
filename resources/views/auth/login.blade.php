@extends('layouts.master2')
@section('title')
    Login
@endsection()

@section('style')
    input.empty {
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
    }
@endsection()

@section('isi')
    
    <div class="w3-row" style="margin-top: 150px">
        <div class="w3-center"><img src="/image/eresourcelogo.png" style="width: 150px"></div><br>
        <div class="col-sm-4"></div>
        <div class="w3-card col-sm-4 w3-white w3-round-large">
            <br>
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input id="email" type="email" class="w3-round-xlarge iconified empty form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="&#xf0e0;   {{ __('E-Mail Address') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="w3-round-xlarge iconified empty form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="&#xf023;     {{ __('Password') }}" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="checkbox">
                    <label style="float: left">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                    </label>
                </div>
                <a style="float: right" class="btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                <br><br>
                <div>
                    <button style="width: 100%" class="btn waves-effect waves-light" type="submit"> {{ __('Login') }}
                    </button>
                </div>
                <br>
                 <p class="">Belum punya akun? <a class="btn-link" href="/register"><i>Sign Up</i></a></p>
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>  

    <script type="text/javascript">
        $('#iconified').on('keyup', function() {
            var input = $(this);
            if(input.val().length === 0) {
                input.addClass('empty');
            } else {
                input.removeClass('empty');
            }
        });

        $(document).ready(function(){
            var width1 = document.getElementById("email").style.width;
            document.getElementById("btnlogin").style.width=width1;
        });

    </script>
@endsection()

{{-- @extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}