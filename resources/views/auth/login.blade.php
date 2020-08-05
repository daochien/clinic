@extends('layouts.app')

@section('content')
<div class="container">
    <main class="main-content col">
        <div class="main-content-container container-fluid px-4 my-auto h-100">
            <div class="row no-gutters h-100">
                <div class="col-lg-6 col-md-6 mx-auto my-auto no-gutters">
                    <div class="mt-5 mb-5">
                        <h1 class="text-center">{{ __('auth.title_form') }} {{ Auth::user()->name?? "" }}</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mx-auto my-auto">
                                    <h3 class="auth-form__title text-center mb-4">{{ __('auth.title_login') }}</h3>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('auth.email_title') }}</label>
                                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                                   value="{{ old('email') }}" required autocomplete="email" autofocus id="exampleInputEmail1"
                                                   aria-describedby="emailHelp" placeholder="{{ __('auth.email_holder') }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">{{ __('auth.password_title') }}</label>
                                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="current-password" id="exampleInputPassword1"
                                                   placeholder="{{ __('auth.password_holder') }}">
                                        </div>
                                        <button type="submit" class="col-12 btn btn-primary mt-3">
                                            {{ __('auth.btn_login') }}
                                        </button>
                                        <div class="form-group mb-0 row">
                                            <div class="col-md-12">
                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link pl-0" href="{{ route('password.request') }}">
                                                        {{ __('auth.forgot_password') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
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
<style type="text/css">
    .auth-form__title {
        font-size: 36px !important;
    }
</style>
