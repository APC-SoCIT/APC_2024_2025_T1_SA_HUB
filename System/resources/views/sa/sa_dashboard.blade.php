@extends('layouts.app')

@section('title', 'Dashboard - Student Assistant')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div>
        @php
        use App\Models\SaTaskTimeLog;
        @endphp
        <div style="padding: 3em;">
            <section>
                <h1 style="text-align: center;"><b> Voluntary Tasks</b></h1>
                    @if (session('accept_task_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('accept_task_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" aria-label="Close">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" aria-label="Close">
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </div>
                    @endif

                    @if (session('error'))   
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" aria-label="Close">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </div>
                    @endif
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col" style="background: #d9d9d9;">TASK NO.</th>
                                <th scope="col" style="background: #d9d9d9;">DATE &amp; TIME</th>
                                <th scope="col" style="background: #d9d9d9;">PROGRAM</th>
                                <th style="background: #d9d9d9;">OFFICE</th>
                                <th style="background: #d9d9d9;">NOTE</th>
                                <th style="background: #d9d9d9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                                @if($urgentTasks->count() == 0)
                                    <tr>
                                        <td data-label="No Task Available" scope="row" colspan="5"><strong> No Task Available </strong></td> 
                                    </tr>
                                @else
                                    @foreach ($urgentTasks as $task)
                                        @php
                                            $saCount = DB::table('user_tasks_timelog')
                                                ->where('task_id',$task->id)
                                                ->where('task_status',1)
                                                ->count();
                                            $isAccepted = DB::table('user_tasks_timelog')
                                                ->where('user_id','=', $user->id)
                                                ->where('task_id', '=',$task->id)
                                                ->exists();
                                            //dd($isAccepted);
                                        @endphp
                                        <tr>
                                            <td data-label="Attributes" scope="row">{{ $task->id }}</td>
                                            <td data-label="Base Class">{{ $task->start_date }}</td>
                                            <td data-label="Simulated Case">{{ $task->preffred_program }}</td>
                                            <td>{{ $task->assigned_office}}</td>
                                            <td>{{ $task->note }}</td>
                                            @if($saCount == $task->number_of_sa)
                                                <td>
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">    
                                                    <button type="submit" class="btn btn-secondary">Full</button>
                                                </td>
                                            @elseif ($isAccepted)
                                                <td>
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <button type="submit" class="btn btn-primary" disabled>Accepted</button>
                                                </td>
                                            @else
                                                <form action="{{ route('sa.accept', $task->id) }}" method="post">
                                                    @csrf
                                                    <td>
                                                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                        <button type="submit" class="btn btn-primary">Accept</button>
                                                    </td>
                                                </form>
                                            @endif
                                        </tr>
                

                                        
                                    @endforeach
                                @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div style="padding: 3em;border-top-style: groove;">
            <section>
                <h1 style="text-align: center;"><b>Criteria-Based Tasks</b></h1>
                <h5 style="text-align: center;">Tasks based on your vacant schedule and program</h5>
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th  scope="col" style="background: #d9d9d9;">TASK NO.</th>
                                <th  scope="col" style="background: #d9d9d9;">DATE &amp; TIME</th>
                                <th  scope="col" style="background: #d9d9d9;">PROGRAM</th>
                                <th  style="background: #d9d9d9;">Task</th>
                                <th  style="background: #d9d9d9;">Office</th>
                                <th  style="background: #d9d9d9;">Note</th>
                                <th style="background: #d9d9d9;"></th>
                                <th style="background: #d9d9d9;"></th>
                            </tr>
                        </thead>
                        <tbody >
                            @if($assignedTasks->count() == 0)
                                    <tr>
                                        <td data-label="Attributes" scope="row" colpan="7"><strong> No Task/s Available </strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                            @else
                                @foreach ($assignedTasks as $assignedtask)
                                    <tr>
                                        <td data-label="Attributes" scope="row">{{ $assignedtask->task_id }}</td>
                                        <td data-label="Base Class">
                                            <p style="margin: 0px;">{{ $assignedtask->start_date }}</p>
                                            <p style="font-size: 12px;">{{ $assignedtask->start_time }} - {{ $assignedtask->end_time }}</p>
                                        </td>
                                        <td data-label="Simulated Case">{{ $assignedtask->preffred_program }}</td>
                                        <td>{{ $assignedtask->to_be_done }}</td>
                                        <td>
                                            <p style="margin: 0px;">{{ $assignedtask->assigned_office }}</p>
                                            <p style="font-size: 12px;">{{ DB::table('users')->where('users.id', '=', $assignedtask->office_id)->select('users.email')->first()->email }}</p>
                                        </td>
                                        <td>{{ $assignedtask->note }}</td>
                                        <td style="font-weight: bold;">
                                            <form action="{{ route('sa.timein') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="task_id" value="{{ $assignedtask->task_id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                @if (!SaTaskTimeLog::where('task_id', $assignedtask->task_id)
                                                    ->where('user_id', $user->id)
                                                    ->whereDate('time_in', now()->toDateString())
                                                    ->exists())
                                                    <button type="submit" class="btn btn-primary">Time-In</button>
                                                @else
                                                    <button type="submit" class="btn btn-secondary disabled" disabled>Time-In</button>
                                                @endif
                                            </form>
                                        </td>
                                        <td style="font-weight: bold;">
                                            <form action="{{ route('sa.timeout') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="task_id" value="{{ $assignedtask->task_id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                @if (!SaTaskTimeLog::where('task_id', $assignedtask->task_id)
                                                    ->where('user_id', $user->id)
                                                    ->whereDate('time_out', now()->toDateString())
                                                    ->exists())
                                                    <button type="submit" class="btn btn-primary">Time-Out</button>
                                                @else
                                                    <button type="submit" class="btn btn-secondary disabled" disabled>Time-Out</button>
                                                @endif
                                            </form>
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