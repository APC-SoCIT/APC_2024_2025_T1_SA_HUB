@extends('layouts.app')

@section('title', 'SA Hub')

@section('content')
    <div class="container position-relative landing m-auto vh-100 vw-100 align-content-center">
        <div class="my-auto mb-3">
            @if (session('error'))
                    <div class="alert alert-danger alert-dismissible show text-center w-50 mx-auto" role="alert" aria-label="Close">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </div>
                @endif
            <img class="imgleft" src="{{ asset('images/landing1.png') }}" alt="">
            <img class="imgright" src="{{ asset('images/logo 1.jpg') }}" alt="" width="200rem">

            <div class="row">
                <p class="outlined-text-accent2 landing-text text-center h1 text-accent1 mb-5 fw-bolder">SA <em
                        class="text-accent2 outlined-text-accent1">HUB</em></p>

                <div class="row card-selection m-auto pb-3">
                    <div class="col-5 col-md-3 p-0">
                        <a class="selection-hover text-center"
                            href="{{ route('login.page', ['id' => 'student-assistant']) }}">
                            <div class="selection-hover px-3">
                                <svg class="landing-img rounded-circle background-accent2 text-accent3 shadow-lg"
                                    xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                                    class="bi bi-people-fill" viewBox="-3.4 0.6 23 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                                <span
                                    class="h1  w-100 mt-4 badge rounded-pill text-accent3 background-accent2 p-3 shadow-lg">
                                    Student Portal
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-5 col-md-3 p-0">
                        <a class="selection-hover border-none text-center"
                            href="{{ route('login.page', ['id' => 'office']) }}">
                            <div class="selection-hover px-3">
                                <svg class=" landing-img rounded-circle background-accent2 text-accent3 shadow-lg"
                                    xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                                    class="bi bi-briefcase-fill" viewBox="-4.5 0 25 16">
                                    <path
                                        d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z" />
                                </svg>
                                <span class="  w-100 mt-4 badge rounded-pill text-accent3 background-accent2 p-3 shadow-lg">
                                    Office Portal
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-5 col-md-3 p-0">
                        <a class="selection-hover border-none text-center" href="{{ route('login.page', ['id' => 'do']) }}">
                            <div class="selection-hover px-3">
                                <svg class=" landing-img rounded-circle background-accent2 text-accent3 shadow-lg"
                                    xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                                    class="bi bi-person-badge-fill" viewBox="-4.5 0 25 16">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z" />
                                </svg>


                                <span class=" w-100 mt-4 badge rounded-pill text-accent3 background-accent2 p-3 shadow-lg">
                                    D.O. Portal
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-5 col-md-3 p-0">
                        <a class="selection-hover border-none text-center"
                            href="{{ route('login.page', ['id' => 'guidance']) }}">
                            <div class="selection-hover px-3">
                                <svg class=" landing-img rounded-circle background-accent2 text-accent3 shadow-lg"
                                    xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                                    class="bi bi-mortarboard-fill" viewBox="-4 1 25 16">
                                    <path
                                        d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
                                    <path
                                        d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
                                </svg>

                                <span class="w-100 mt-4 badge rounded-pill text-accent3 background-accent2 p-3 shadow-lg">
                                    Guidance Portal
                                </span>
                            </div>
                    </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
