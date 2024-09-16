@extends('layouts.app')

@section('title', 'Dashboard - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
            <div class="text-center" style="padding: 3em;">
                <div style="padding: 3em;">
                    <div class="d-xl-flex justify-content-xl-center align-items-xl-center" style="width: 100%;height: 4em;">
                        <h3>Task Review</h3>
                    </div>
                <section>
                    <div class="table-responsive" style="padding: 1em;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="background: #d9d9d9;">Task No.</th>
                                    <th scope="col" style="background: #d9d9d9;">Date &amp; Time</th>
                                    <th scope="col" style="background: #d9d9d9;">Program</th>
                                    <th style="background: #d9d9d9;">Task</th>
                                    <th style="background: #d9d9d9;">Hours</th>
                                    <th style="background: #d9d9d9;">Note</th>
                                    <th style="background: #d9d9d9;">Task Accepts</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($saLists as $saList)
                                <tr>
                                    <td data-label="Attributes" scope="row">{{$saList.first_name}} {{$saList.last_name}}</td>
                                    <td data-label="Base Class">Cell 2</td>
                                    <td data-label="Simulated Case">Cell 3</td>
                                    <td>Cell 4</td>
                                    <td>Cell 5</td>
                                    <td>Cell 5</td>
                                    <td style="font-weight: bold;"><button class="btn btn-primary" type="button" style="background: rgba(13,110,253,0);color: rgb(0,0,0);border-style: none;" data-bs-toggle="modal" data-bs-target="#addFeedback"><strong>Add Feedback</strong></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        
        @if($salists->count() >= 1)
            @include('modals.sa_list')
        @endif

    @include('nav.offcanvas_menu_office')
@endsection