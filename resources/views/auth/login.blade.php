@extends('layouts.master2')
@section('title')
    Login
@endsection()

@section('style')
    .text{
        color:white;
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
    }
    .text:nth-child(-n+2){
        color:black;
    }

    #verline1{
        border-right: 1px solid white;
        height: 450px;
    }
    #verline2{
        border-left: 1px solid white;
        height: 450px;
    }
@endsection()

@section('isi')
    <div class="container w3-row" style="margin-top: 100px">
        <div style" class="col-sm-6" id="verline1">
                <div style="margin-top:90px;" class="w3-center">
                    <img src="/image/eresourcelogo.png" style="width: 300px">
                </div><br>
                <div class="col-sm-2"></div>
                <div class="col-sm-10 text">
                    <p>Pengenalan e-resources ITS</p>
                    <p>Pengenalan ITS digital repository</p>
                    <p>Cara mengakses dan memanfaatkan e-journal</p>
                    <p>Cara mengakses dan memanfaatkan ITS digital repository</p>
                </div>
        </div>
    
        <div class="col-sm-6" id="verline2">
            <div class="col-sm-1"></div>
            <div style="margin-top:43.5px;" class="col-sm-10 w3-card w3-white w3-round-large"><br>
                <h1 class="text w3-center">Login</h1><br>    
                <form style="height: 260px" action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input id="email" type="email" class="w3-round-xlarge iconified text form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="&#xf0e0;   {{ __('E-Mail Address') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="w3-round-xlarge iconified text form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="&#xf023;     {{ __('Password') }}" required>
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
        </div>
    </div>  

    <script type="text/javascript">
        $('#iconified').on('keyup', function() {
            var input = $(this);
            if(input.val().length === 0) {
                input.addClass('text');
            } else {
                input.removeClass('text');
            }
        });


    </script>
@endsection()