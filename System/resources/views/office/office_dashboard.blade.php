@extends('layouts.app')

@section('title', 'Dashboard - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="text-center" style="padding: 3em;">
            <section class="mt-5">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </div>
                @endif
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="table-warning">
                                <th scope="col">Task No.</th>
                                <th scope="col">Date &amp; Time</th>
                                <th scope="col">Program</th>
                                <th>Task</th>
                                <th>Hours</th>
                                <th>Note</th>
                                <th>Task Accepts</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(empty($tasksWithInfo))  
                                <tr>
                                    <td data-label="No Task Available" scope="row" colspan="8"><strong> No Task Available </strong></td> 
                                </tr>
                            @else
                                @foreach($tasksWithInfo as $task)
                                <tr>
                                    <td data-label="{{$task->id}}" scope="row">{{$task->id}}</td>
                                    <td data-label="{{$task->start_date}}">
                                        <div>
                                            <div>{{$task->start_date}}</div>
                                            <div style="font-size: 11px">{{$task->startTimeFormatted}} - {{$task->endTimeFormatted}}</div>
                                        </div>    
                                    </td>
                                    <td data-label="{{$task->preffred_program}}">{{$task->preffred_program}}</td>
                                    <td data-label="{{$task->to_be_done}}">{{$task->to_be_done}}</td>
                                    <td data-label="{{$task->totalHours}}">{{$task->totalHours}}</td>
                                    <td data-label="{{$task->note}}">{{$task->note}}</td>
                                    <td data-label="{{ $task->saCount }} /{{$task->number_of_sa}} ">
                                        <a href="{{ route('office.saList', $task->id) }}" class="btn 
                                        @if ($task->saCount < $task->number_of_sa)
                                            btn-outline-success 
                                        @elseif ($task->saCount = $task->number_of_sa) 
                                            btn-outline-danger 
                                        @endif
                                        " > 
                                        @if ($task->saCount < $task->number_of_sa)
                                            {{ $task->saCount }} /{{$task->number_of_sa}} 
                                        @elseif ($task->saCount = $task->number_of_sa) 
                                            Full
                                        @endif
                                            
                                        </a>
                                    </td>

                                    <td style="font-weight: bold;">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTaskModal-{{ $task->id }}">Edit</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTaskModal-{{ $task->id }}">Delete</button>
                                    </td>
                                    @include('modals.edit_task')
                                    @include('modals.delete_task')
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
            <div style="text-align: center;">
                <a class="btn btn-success" href="{{ route('office.add.task') }}" >&nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-lg" style="width: 25px;height: 25px;">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"></path>
                    </svg> &nbsp;Add Task
                </a>
            </div>
        </div>
    @include('modals.add_task')
    @include('nav.offcanvas_menu_office')
@endsection