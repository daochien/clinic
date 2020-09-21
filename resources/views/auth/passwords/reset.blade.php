@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="main-content col">
            <div class="main-content-container container-fluid px-4 my-auto h-100">
                <div class="row no-gutters h-100">
                    <div class="col-lg-6 col-md-6 mx-auto my-auto no-gutters">
                        <div class="mt-5 mb-5">
                            <h1 class="text-center">{{ __('auth.title_form') }}</h1>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8 mx-auto my-auto">
                                        <h3 class="auth-form__title text-center mb-4">{{ __('auth.title_reset') }}</h3>
                                        <form method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('auth.email_title') }}</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">{{ __('auth.password_title') }}</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm">{{ __('auth.confirm_password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>

                                            <button type="submit" class="col-12 btn btn-primary mt-3">
                                                {{ __('auth.reset_btn') }}
                                            </button>
                                            <a href="/login">
                                                {{ __('auth.reset_pwd.others._link_back_to_login') }}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
