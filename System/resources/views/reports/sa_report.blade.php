@extends('layouts.app')

@section('title', 'SA Reports - Student Assistant Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="text-center" style="padding: 3em;">
            <div class="d-flex d-lg-flex justify-content-center justify-content-lg-center align-items-lg-center" style="padding: 3em;">
                <div class="row">
                    <div class="col text-center" style="margin: auto;border-bottom-style: none;padding: 1em;">
                        <button onclick="window.location.href='{{ route('report.saReport','ongoing') }}'" class="btn 
                            @if($status === 'ongoing') 
                                btn-warning 
                            @else 
                                btn-secondary 
                            @endif
                            " 
                            type="button" style="width: 20em;color: rgb(0,0,0);font-weight: bold;height: 3em;font-size: 1em;border-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;border-left-style: none;">
                            Ongoing SA 
                        </button>
                    </div>
                    <div class="col text-center" style="margin: auto;padding: 1em;">
                        <button onclick="window.location.href='{{ route('report.saReport','completed') }}'" class="btn 
                        @if($status === 'ongoing') 
                            btn-secondary 
                        @else 
                            btn-warning 
                        @endif
                        " 
                         type="button" style="width: 20em;color: rgb(0,0,0);font-weight: bold;margin: auto;height: 3em;font-size: 1em;border-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;border-left-style: none;">
                            Completed SA
                        </button>
                    </div>
                </div>
            </div>
            <section>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </div>
                @endif
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="table-warning">
                                <th scope="col">Student Name</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Student Email</th>
                                <th>Hours Rendered</th>
                            </tr>
                        </thead>
                        @if ($status === 'ongoing')
                            <tbody>
                                @if($saLists->count() == 0)
                                    <tr>
                                            <td data-label="Attributes" scope="row" colpan="6"><strong> None </strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>                                        
                                    </tr>
                                @else
                                    @foreach($saLists as $task)
                                    <tr>
                                        <td data-label="{{$task->first_name}} {{$task->last_name}}" scope="row">{{$task->first_name}} {{$task->last_name}}</td>
                                        <td data-label="{{$task->id_number}}">{{$task->id_number}}</td>
                                        <td data-label="{{$task->email}}">{{$task->email}}</td>
                                        <td data-label="{{$task->total_hours}}" class="
                                            @if ($task->total_hours == 0)
                                                table-danger 
                                            @elseif ($task->total_hours > 0) 
                                                table-primary
                                            @endif    
                                        "><strong>{{$task->total_hours}}</strong></td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        @elseif($status === 'completed') 
                            <tbody>
                                @if($saLists->count() == 0)
                                    <tr>
                                            <td data-label="Attributes" scope="row" colpan="6"><strong> None </strong></td>
                                                                                  
                                    </tr>
                                @else
                                    @foreach($saLists as $task)
                                    <tr>
                                        <td data-label="{{$task->first_name}} {{$task->last_name}}" scope="row">{{$task->first_name}} {{$task->last_name}}</td>
                                        <td data-label="{{$task->id_number}}">{{$task->id_number}}</td>
                                        <td data-label="{{$task->email}}">{{$task->email}}</td>
                                        <td data-label="{{$task->total_hours}}" class="
                                            @if ($task->total_hours == 0)
                                                table-danger 
                                            @elseif ($task->total_hours >= 90) 
                                                table-success
                                            @elseif ($task->total_hours > 0) 
                                                table-primary
                                            @endif    
                                            ">  <strong>{{$task->total_hours}}  
                                            
                                                @if ($task->total_hours >= 90) 
                                                    (Completed)
                                                @endif 
                                                </strong>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        @endif
                    </table>
                </div>
            </section>
    @include('nav.offcanvas_menu_sam')
</div>
@endsection