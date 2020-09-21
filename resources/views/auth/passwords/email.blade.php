@extends('layouts.app')

@section('content')
<div class="container">
    <main class="main-content col">
        <div class="main-content-container container-fluid px-4 my-auto h-100">
            <div class="row no-gutters h-100">
                <div class="col-lg-6 col-md-6 mx-auto my-auto no-gutters">
                    <div class="mt-5 mb-5">
                        <h1 class="text-center">{{ __('auth.reset_pwd._page_title') }}</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mx-auto my-auto">
                                    <h3 class="auth-form__title text-center mb-4">{{ __('auth.reset_pwd.form._subtitle') }}</h3>
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('auth.reset_pwd.form._mail_address') }}</label>
                                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                                   value="{{ old('email') }}" required autocomplete="email" autofocus id="exampleInputEmail1"
                                                   aria-describedby="emailHelp" placeholder="{{ __('auth.reset_pwd.form._mail_address_pl') }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="col-12 btn btn-primary mt-3 mb-2">
                                            送信
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
