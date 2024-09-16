@extends('layouts.app')

@section('title', 'Dashboard - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="text-center" style="padding: 3em;">
            <div class="d-flex d-lg-flex justify-content-center justify-content-lg-center align-items-lg-center" style="padding: 3em;">
                <div class="row">
                    <div class="col text-center" style="margin: auto;border-bottom-style: none;padding: 1em;">
                        <button onclick="window.location.href='{{ route('office.admin.active.dashboard') }}'" class="btn btn-warning" type="button" style="width: 20em;color: rgb(0,0,0);font-weight: bold;height: 3em;font-size: 1em;border-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;border-left-style: none;">
                            Active
                        </button>
                    </div>
                    <div class="col text-center" style="margin: auto;padding: 1em;">
                        <button onclick="window.location.href='{{ route('office.admin.inactive.dashboard') }}'" class="btn btn-secondary" type="button" style="width: 20em;color: rgb(0,0,0);font-weight: bold;margin: auto;height: 3em;font-size: 1em;border-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;border-left-style: none;">
                            Cancelled
                        </button>
                    </div>
                </div>
            </div>
            <section>
            @if (session('add_task_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('add_task_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </div>
            @endif
            @if (session('cancel_task_success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('cancel_task_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </div>
            @endif
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
                                <th style="background: #d9d9d9;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tasks->count() == 0)
                                <tr>
                                        <td data-label="Attributes" scope="row" colpan="6"><strong> No Active Task Available </strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                </tr>
                            @else
                                @foreach($tasks as $task)
                                <tr>
                                    @php
                                        $startTime = strtotime($task->start_time);
                                        $endTime = strtotime($task->end_time);
                                        $startTimeampm = date("h:i A", strtotime($task->start_time));
                                        $endTimeampm = date("h:i A", strtotime($task->end_time));
                                        $totalHours = round(($endTime - $startTime) / 3600, 1);
                                        $saCount = (DB::table('user_tasks')->where('task_id',$task->id)->where('task_status_id',1)->count()) ? DB::table('user_tasks')->where('task_id',$task->id)->where('task_status_id',1)->count() : '0' ;
                                    @endphp

                                    <td data-label="{{$task->id}}" scope="row">{{$task->id}}</td>
                                    <td data-label="{{$task->start_date}}">
                                        <div>
                                            <p style="margin: 0px;">{{$task->start_date}}</p>
                                            <p style="font-size: 12px">{{$startTimeampm}} - {{$endTimeampm}}</p>
                                        </div>    
                                    </td>
                                    <td data-label="{{$task->preffred_program}}">{{$task->preffred_program}}</td>
                                    <td data-label="{{$task->to_be_done}}">{{$task->to_be_done}}</td>
                                    <td data-label="{{$totalHours}}">{{$totalHours}} Hrs</td>
                                    <td data-label="{{$task->note}}">{{$task->note}}</td>
                                    <td data-label="{{ $saCount }} /{{$task->number_of_sa}} ">
                                        <a href="{{ route('office.saList', $task->id) }}" class="btn btn-info" > 
                                            {{ $saCount }} /{{$task->number_of_sa}} 
                                        </a>
                                    </td>

                                    @if($task->isActive == true && now()->diffInHours($task->start_date, false) <= 24 && now() <= $task->start_date)
                                        <td style="font-weight: bold;">
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cancelTaskModal-{{ $task->id }}">Cancel</button>
                                        </td>
                                        @include('modals.cancel_task')
                                    @else
                                        <td style="font-weight: bold;">
                                            <button class="btn btn-secondary" disabled>Cancel</button>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
            <div style="text-align: center;">
                <button class="btn btn-info" type="button" style="font-size: 18px;color: rgb(0,0,0);font-weight: bold;border-style: none;" data-bs-toggle="modal" data-bs-target="#addTask">
                    &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-lg" style="width: 25px;height: 25px;">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"></path>
                    </svg> 
                    &nbsp;
                    Add Task</button></div>
        </div>
        @if($tasks->count() >= 1)
            @include('modals.edit_task')
        @endif
    @include('modals.add_task')
    @include('nav.offcanvas_menu_office')
@endsection