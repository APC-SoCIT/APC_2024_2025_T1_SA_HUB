@extends('layouts.app')

@section('title', 'SA List - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="text-center" style="padding: 3em;">
    <section>
            @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" aria-label="Close">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </div>
                    @endif
    </section>
    <div style="padding: 3em;">
    <div class="d-xl-flex justify-content-xl-center align-items-xl-center" style="width: 100%;height: 4em;">
        <h3>Task Review</h3>
    </div>
    <section>
        <div class="d-xl-flex justify-content-xl-center align-items-xl-center" style="width: 100%;height: 3em;padding: 8px;background: #d9d9d9;margin: 0px;">
            <h5>Task {{$taskId}}</h5>
        </div>
        <div class="table-responsive" style="padding: 1em;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="background: #d9d9d9;">Student No.</th>
                        <th scope="col" style="background: #d9d9d9;">SA Name</th>
                        <th scope="col" style="background: #d9d9d9;">Course</th>
                        <th style="background: #d9d9d9;">Latest Time In</th>
                        <th style="background: #d9d9d9;">Latest Time Out</th>
                        <th style="background: #d9d9d9;">Hours Rendered</th>
                        <th style="background: #d9d9d9;">Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($saLists))  
                                <tr>
                                    <td data-label="No SA Available" scope="row" colspan="8"><strong> No SA Available </strong></td> 
                                </tr>
                    @else
                        @foreach($saLists as $saList)
                            <tr>
                                <td data-label="Attributes" scope="row">{{$saList->user_id}}</td>
                                <td data-label="Base Class">{{$saList->first_name}} {{$saList->last_name}}</td>
                                <td data-label="Simulated Case">{{$saList->course_program}}</td>
                                <td>
                                    @if($saList->timein == null)
                                        No Time-In Yet
                                    @else
                                        {{$saList->timein}}
                                    @endif
                                </td>
                                <td>
                                    @if($saList->timeout == null)
                                        No Time-Out Yet
                                    @else
                                        {{$saList->timeout}}
                                    @endif
                                </td>

                                <td>
                                    @if($saList->total_hours <= 0 )
                                        Not Yet Started
                                    @else
                                        {{$saList->total_hours}} Hr(s) 
                                    @endif
                                </td>
                                <td style="font-weight: bold;">
                                    <button class="btn {{ $saList->timeout ? 'btn-info' : 'btn-warning '}}" type="button" style="font-size: 12px;color: rgb(0,0,0);font-weight: bold;border-style: none;" data-bs-toggle="modal" data-bs-target="#feedbackModal-{{ $saList->timelogId }}" {{ $saList->timeout ? ' ' : 'disabled' }} > 
                                        {{ $saList->timeout ? 'Add/Edit Feedback' : 'Finish Task First'}}
                                    </button>
                                    @include('modals.feedback')
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</div>
    @include('nav.offcanvas_menu_office')
@endsection