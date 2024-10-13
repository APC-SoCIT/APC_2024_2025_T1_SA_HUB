@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container vh-100">
        <div class="row align-items-center">
            <div class="col">
                <img class="imgleft" src="{{ asset('images/landing1.png') }}" alt="">
                <img class="imgright" src="{{ asset('images/logo 1.jpg') }}" alt="" width="200rem">
                <div class="row  justify-content-center">
                    <div class="col-sm-8 col-md-6">
                        <div class="card login background-accent2 text-accent1 py-1 py-md-3 mb-2">
                            {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                            <div class="card-body d-flex flex-column align-items-center">
                                <img class="img mb-2 d-none d-md-block" src="{{ asset('images/logo2.png') }}" alt=""
                                    width="100px">
                                    <h1>{{$portalName}}</h1>
                                <h2 class="mb-5 text-capitalize font-monospace">{{ __('Log in') }}</h2>
                                <form class="login-form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <input type="hidden" name="portal_details" value="{{$portalName}}">
                                    <div class="row mb-3">
                                        {{-- <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                                        <div class="col p-0 w-100">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        {{-- <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                                        <div class="col p-0 w-100">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password" placeholder="Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col text-center">
                                            <button type="submit"
                                                class="btn background-accent1 text-accent2 badge rounded-pill py-3 fw-bolder d-block w-100">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn text-accent1 forgot-password" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row login-back align-items-center justify-content-center">
                            <a class="btn background-accent2 text-accent1 badge rounded-pill py-3 h3 w-25 change-page"
                                href="{{ route('landing') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                    <path fill-rule="evenodd"
                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                </svg>
                                Go back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
