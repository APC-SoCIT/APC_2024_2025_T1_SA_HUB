@extends('layouts.app')

@section('title', 'Dashboard - Student Assistant')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div>
        <div style="padding: 3em;border-bottom-style: groove;">
            <div>
                <h2 style="text-align: center;"><b>Student Assistant Profile</b></h2>
            </div>
            <div class="card">
  <div class="card-body"  style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
    @foreach($userProfiles as $userProfile)
      <div class="d-lg-flex align-items-lg-center mt-3">
        <p class="d-lg-flex" style="font-weight: bold;">&nbsp; Name :&nbsp;</p>
        <p>{{$userProfile->first_name}} {{$userProfile->middle_initial}}. {{$userProfile->last_name}}</p>
      </div>
      <div class="d-lg-flex align-items-lg-center">
        <p class="d-lg-flex" style="font-weight: bold;">&nbsp; Student ID :&nbsp;</p>
        <p>{{$user->id_number}}</p>
      </div>
      <div class="d-lg-flex align-items-lg-center">
        <p class="d-lg-flex" style="font-weight: bold;">&nbsp; Program :&nbsp;</p>
        <p>{{$userProfile->course_program}}</p>
      </div>
      <div class="d-lg-flex align-items-lg-center">
        <p class="d-lg-flex" style="font-weight: bold;">&nbsp; Contact Details :&nbsp;</p>
        <p>{{$user->email}} | +{{$userProfile->contact_number}}</p>
      </div>
    @endforeach
  </div>
</div>



        <div style="padding: 2em; border-bottom-style: groove;">
            <section>
                <h3 style="text-align: center;">Class Schedule</h3>
                <h6 style="text-align: center;margin-bottom: 0px;">SY {{$term}} Term 1</h6>
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="background: #d9d9d9;">Subject</th>
                                <th scope="col" style="background: #d9d9d9;">Section</th>
                                <th scope="col" style="background: #d9d9d9;">Day</th>
                                <th style="background: #d9d9d9;">Time</th>
                                <th style="background: #d9d9d9;">Instructor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedule as $class)
                                <tr>
                                    <td data-label="Subject Code">{{ $class->subject_code }}</td>
                                    <td data-label="Section">{{ $class->section }}</td>
                                    <td data-label="Day">{{ $class->day }}</td> 
                                    <td data-label="Time">{{ $class->time_constraints }}</td>
                                    <td data-label="Instructor"> TBA </td> <!-- {{ $class->instructor->name ?? 'TBA'}} -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div style="padding: 2em;">
            <section>
                <h3 style="text-align: center;">Task History</h3>
                <h6 style="text-align: center;margin-bottom: 0px;">
                
                @foreach($rendered as $render)
                    @if(empty($render->total_hours) && $render->total_hours === null)
                        0
                    @else
                        {{$render->total_hours}}
                    @endif
                @endforeach
                
                / 90 Hour(s) Rendered</h6>
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="background: #d9d9d9;">Task no.</th>
                                <th scope="col" style="background: #d9d9d9;">Task Date &amp; Time</th>
                                <th scope="col" style="background: #d9d9d9;">Time-In</th>
                                <th scope="col" style="background: #d9d9d9;">Time-Out</th>
                                <th style="background: #d9d9d9;">Hours Rendered</th>
                                <th style="background: #d9d9d9;">Program</th>
                                <th scope="col" style="background: #d9d9d9;">Task</th>
                                <th style="background: #d9d9d9;">Office</th>
                                <th style="background: #d9d9d9;">Note</th>
                                
                                <th style="background: #d9d9d9;">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(empty($taskHistory) || $taskHistory==null )
                                <td data-label="Attributes" scope="row" colpan="6"><strong> No Pending Task/s </strong></td>
                            @else
                                @foreach($taskHistory as $taskHistory)
                                <tr>
                                    <td data-label="Task No." scope="row">{{$taskHistory->id}}</td>
                                    <td data-label="Date &amp; Time">{{$taskHistory->start_date}}</td>
                                    <td data-label="{{$taskHistory->time_in}}">
                                        @if($taskHistory->time_in == null)
                                            No Time-In Yet
                                        @else
                                            {{$taskHistory->time_in}}
                                        @endif
                                    </td>
                                    <td data-label="{{$taskHistory->time_out}}">
                                        @if($taskHistory->time_out == null)
                                            No Time-Out Yet
                                        @else
                                            {{$taskHistory->time_out}}
                                        @endif
                                    </td>
                                    
                                    <td data-label="{{$taskHistory->total_hours}}">
                                        @if($taskHistory->total_hours == null)
                                            No Rendered Hrs
                                        @else
                                            {{$taskHistory->total_hours}}
                                        @endif
                                    </td>
                                    <td data-label="Program">{{$taskHistory->preffred_program}}</td>
                                    <td data-label="Task">{{$taskHistory->to_be_done}}</td>
                                    <td data-label="Office">{{$taskHistory->assigned_office}}</td>
                                    <td data-label="Note">{{$taskHistory->note}}</td>
                                    
                                    <td data-label="Feedback">
                                    
                                        @if($taskHistory->feedback == null)
                                            No Feedback
                                        @else
                                            {{$taskHistory->feedback}}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>


    @include('nav.offcanvas_menu_sa')
@endsection

