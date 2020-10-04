@extends('layouts.app')

@section('content')
    <div class="page-title center">
        <div class="container">
            <a href="/login" class="back">← {{ __('auth.reset_pwd.others._link_back_to_login') }}</a>
            <h1><img src="/front-end/images/logo.png" alt=""></h1>
            {{ __('auth.reset_pwd.form._form_title') }}
        </div>
    </div>
    <div class="page-content white-content">
        <div class="container">
            <form method="POST" action="{{ route('password.update') }}" class="login-form">@csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('auth.attr._mail_address') }}</label>
                    <input id="email" type="email" class="form-control email @error('email') is-invalid @enderror" readonly="readonly"
                           name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{ __('auth.attr._new_password') }}</label>
                    <input id="password" type="password" class="form-control password @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">{{ __('auth.attr._confirm_password') }}</label>
                    <input id="password-confirm" type="password" class="form-control password" name="password_confirmation" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn btn-login">{{ __('auth.reset_pwd.others._btn_reset') }}</button>
            </form>
        </div>
    </div>
@endsection
