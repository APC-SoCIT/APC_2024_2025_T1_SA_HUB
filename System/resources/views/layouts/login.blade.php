@extends('layouts.app')

@section('title', 'Login')

@section('content')
        <section class="position-relative py-4 py-xl-5 mt-5">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-5">
                            <div class="card-body d-flex flex-column align-items-center" style="background-color: #E7AE41;">
                                <div class="d-flex justify-content-center p-3"  >
                                    <img src="https://signin.apc.edu.ph/images/logo.png" alt="logo" width="120px"></div>
                                    <h4 class="mb-2"><b>{{ __('APC Information System') }}</b></h4>
                                    <h6 class="mb-4">{{ __('Login with Office 365 Account') }}</h6>
                                    </div>
                                    <div class="card-body d-flex flex-column align-items-center">
                                <form class="text-center" method="POST" action="{{ route('authenticate') }}">
                                    @csrf
                                    <div class="mb-3">
                                    <input class="form-control" type="email" name="email" placeholder="{{ __('Email') }}">
                                        <span class="text-danger"> @error('id_number') {{$message}} @enderror</span>
                                    </div>

                                    <div class="mb-3">
                                        <input class="form-control" type="password" name="password" placeholder="{{ __('Password') }}">
                                        <span class="text-danger"> @error('password') {{$message}} @enderror</span>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary d-block w-100" type="submit" style="background-color: #293A82;">{{ __('Login') }}</button>
                                </div>


                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
          
        </section>
@endsection