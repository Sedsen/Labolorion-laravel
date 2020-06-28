@extends('lorion/template')

@section('content')
    <div class="container" >
           <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8" style="margin-bottom:30px;margin-top:50px;">
                <div class="card">
                    <div class="card-header h5 bg-secondary text-center text-light" style="background-color:rgba(255, 255, 255, 0.5);">{{  __('Se connecter') }}</div>
                     @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Addresse E-Mail ') }}</label>

                                <div class="col-md-5">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                <div class="col-md-5">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Se souvenir de moi') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Se connecter') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Mot de passe oublié?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label for="social" class="col-md-4 control-label"> Se connecter avec </label>
                                <div class="row">

                                </div>
                                <div class="col-md-8 col-offset-2">
                                    <a href=" {{ url('login/twitter') }} " class="btn btn-social-icon btn-twitter">
                                        <i class="fa-twitter"></i> Twitter </a>
                                        <a href=" {{ url('login/facebook') }} " class="btn btn-social-icon btn-facebook">
                                        <i class="fa-facebook"></i> Facebook </a>
                                </div>
                            </div>-->
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
