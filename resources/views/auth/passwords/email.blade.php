@extends('layouts.master2')
@section('title')
    Konfirmasi Email
@endsection()

@section('style')
    body{
        color:#ffc107!important;
        background-color: #00748d!important;
    }

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
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="col-sm-1"></div>
            <div style="margin-top:43.5px;" class="col-sm-10 w3-card w3-white w3-round-large"><br>
                <h1 class="text w3-center">Reset Password</h1><br>    
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form style="height: 110px" action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label w3-center">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
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
