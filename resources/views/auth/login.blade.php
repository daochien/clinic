@extends('layouts.app')
@section('content')
    <div class="page-title center">
        <div class="container">
            <h1><a href="#"><img src="/front-end/images/logo.png" alt=""></a></h1>
            {{ __('auth.login.form._subtitle') }}
        </div>
    </div>
    <div class="page-content white-content">
        <div class="container">
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('auth.login.form._mail_address') }}</label>
                    <input type="email" class="form-control email @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" autofocus id="exampleInputEmail1"
                           aria-describedby="emailHelp">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('auth.login.form._password') }}</label>
                    <input type="password" class="form-control password @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-login">{{ __('auth.login.others._btn_login') }}</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link pl-0" href="{{ route('password.request') }}">
                        {{ __('auth.login.others._link_forgot_password') }}
                    </a>
                @endif
            </form>
        </div>
    </div>
@endsection
