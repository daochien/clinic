@extends('layouts.app')

@section('content')
    <div class="page-title center">
        <div class="container">
            <a href="/login" class="back">← {{ __('auth.reset_pwd.others._link_back_to_login') }}</a>
            <h1><img src="/front-end/images/logo.png" alt=""></h1>
            {{ __('auth.reset_pwd.form._subtitle') }}
        </div>
    </div>
    <div class="page-content white-content">
        <div class="container">

            <form method="POST" action="{{ route('password.email') }}" class="login-form"> @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('auth.reset_pwd.form._mail_address') }}</label>
                    <input type="email" class="form-control email @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" autofocus id="exampleInputEmail1"
                           aria-describedby="emailHelp">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login">パスワード再設定メール送信</button>
            </form>
        </div>
    </div>
@endsection
