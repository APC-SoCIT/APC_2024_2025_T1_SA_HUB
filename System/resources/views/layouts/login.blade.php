@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="container position-relative  m-auto vh-100 vw-100 align-content-center">
        <div class="">
            <img class="imgleft" src="{{ asset('images/landing1.png') }}" alt="">
            <img class="imgright" src="{{ asset('images/logo 1.jpg') }}" alt="" width="200rem">

            <div class="row d-flex justify-content-center mb-3">
                <div class="col-md-6 col-xl-4">
                    <div class="card background-accent2 text-accent1 p-5">
                        <div class="card-body d-flex flex-column align-items-center">
                            <img class="img mb-2" src="{{ asset('images/logo2.png') }}" alt="" width="100px">
                            <h2 class="mb-5 text-capitalize font-monospace">{{ __('Log in') }}</h2>

                            <form class="text-center" method="POST" action="{{ route('authenticate') }}">
                                @csrf
                                <div class="mb-3">
                                    <input class="form-control" type="email" name="email"
                                        placeholder="{{ __('Email') }}">
                                    <span class="text-danger"> @error('id_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="mb-5">
                                    <input class="form-control" type="password" name="password"
                                        placeholder="{{ __('Password') }}">
                                    <span class="text-danger"> @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <button
                                        class="btn background-accent1 text-accent2 badge rounded-pill py-3 fw-bolder d-block w-100"
                                        type="submit">{{ __('Sign In') }}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <a class="btn background-accent2 text-accent1 badge rounded-pill py-3 h3 w-25 change-page" href="{{ url()->previous() }}">
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
    </section>
@endsection
