@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                    <label for="username">NRP</label><br>
                    <input id="nrp" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nrp" value="{{ old('nrp') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Name</label><br>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="faculty">Faculty</label>
                    <select class="form-control" name="faculty" id="facultyoption" required>
                    <option disabled="true" selected>-- Please select your faculty --</option>
                    <option value="FAKULTAS TEKNOLOGI INDUSTRI">FAKULTAS TEKNOLOGI INDUSTRI</option>
                    <option value="FAKULTAS TEKNOLOGI KELAUTAN">FAKULTAS TEKNOLOGI KELAUTAN</option>
                    <option value="FAKULTAS TEKNOLOGI ELEKTRO">FAKULTAS TEKNOLOGI ELEKTRO</option>
                    <option value="FAKULTAS TEKNIK SIPIL, LINGKUNGAN, DAN KEBUMIAN">FAKULTAS TEKNIK SIPIL, LINGKUNGAN, DAN KEBUMIAN</option>
                    <option value="FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI">FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI</option>
                    <option value="FAKULTAS ARSITEKTUR, DESAIN, DAN PERENCANAAN">FAKULTAS ARSITEKTUR, DESAIN, DAN PERENCANAAN</option>
                    <option value="FAKULTAS SAINS">FAKULTAS SAINS</option>
                    <option value="FAKULTAS MATEMATIKA, KOMPUTASI, DAN SAINS DATA">FAKULTAS MATEMATIKA, KOMPUTASI, DAN SAINS DATA</option>
                    <option value="FAKULTAS VOKASI">FAKULTAS VOKASI</option>
                    <option value="FAKULTAS BISNIS DAN MANAJEMEN TEKNOLOGI">FAKULTAS BISNIS DAN MANAJEMEN TEKNOLOGI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="department">Department</label>
                    <select class="form-control" name="department" id="departoption" required>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label><br>
                    <input type="text" id="phone" class="form-control" value="{{ old('phone') }}" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label><br>
                    <input name="email" input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label><br>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label><br>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <button class="btn waves-effect waves-light" type="submit" name="action">Register
                </button>

                        <!-- <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

<!--                         <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
 -->
                        <!-- <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("select#facultyoption").change(function(){
            var selectedCountry = $("#facultyoption option:selected").val();
            if(selectedCountry=="FAKULTAS TEKNOLOGI INDUSTRI"){
                $('#departoption').empty();
                $('#departoption').append("<option>mesin</option><option>Elektro</option>")
            }
            else if(selectedCountry=="FAKULTAS TEKNOLOGI KELAUTAN"){
                $('#departoption').empty();
                $('#departoption').append("<option>infor</option><option>SI</option>")
            }
            else if(selectedCountry=="FAKULTAS TEKNOLOGI ELEKTRO"){
                $('#departoption').empty();
                $('#departoption').append("<option>mat</option><option>bio</option>")
            }
        });
    });
</script>
@endsection
