@extends('layouts.app')

@section('title', 'Dashboard - Student Assistant Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')

    <div class="main-background">
        <div class="d-flex d-lg-flex justify-content-center justify-content-lg-center align-items-lg-center"
            style="padding: 3em;">
            <div class="row">
                <div class="col text-center">
                    <a href='{{ route('sa.manager.dashboard.ongoing') }}'
                        class="btn going background-accent2 text-accent1 border opacity"
                        >
                        On-going
                    </a>
                </div>
                <div class="col text-center">
                    <a href='{{ route('sa.manager.dashboard.done') }}'
                        class="btn going background-accent1 text-accent2 border text-nowrap active-going"
                        >
                        Done
                    </a>
                </div>
            </div>
        </div>
        <div style="padding: 3em; padding-top: 2rem ; border-top-style: groove;">
            <section>
                <h1 class="text-center">Completed Tasks</h1>
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover table-border rounded">
                        <thead class="background-accent1">
                            <tr>
                                <th class="table-border2 rounded">TASK NO.</th>
                                <th class="table-border2 rounded">DATE &amp; TIME</th>
                                <th class="table-border2 rounded">PROGRAM</th>
                                <th class="table-border2 rounded">Task</th>
                                <th class="table-border2 rounded">Office</th>
                                <th class="table-border2 rounded">Note</th>
                                <th class="table-border2 rounded">Rendered Hours</th>
                                <th class="table-border2 rounded">SA</th>
                            </tr>
                        </thead>
                        <tbody class="background-accent3">
                            @php
                                $taskFound = false;
                            @endphp

                            @foreach ($assignedTasks as $task)
                                @if ($task->task_status == 2)
                                    @php
                                        $taskFound = true;

                                    @endphp
                                    <tr>
                                        <td class="table-border2 rounded text-center">{{ $task->task_id }}</td>
                                        <td class="table-border2 rounded text-center">
                                            <p style="margin: 0px;">{{ $task->start_date }}</p>
                                            <p style="font-size: 12px;">{{ $task->start_time }} - {{ $task->end_time }}</p>
                                        </td>
                                        <td class="table-border2 rounded text-center">{{ $task->preffred_program }}</td>
                                        <td class="table-border2 rounded text-center">{{ $task->to_be_done }}</td>
                                        <td class="table-border2 rounded text-center">
                                            <p style="margin: 0px;">{{ $task->assigned_office }}

                                            </p>
                                            <p style="font-size: 12px;">
                                                {{ DB::table('users')->where('users.faculty', '=', $task->assigned_office)->select('users.email')->first()->email }}
                                            </p>
                                        </td>
                                        <td class="table-border2 rounded text-center">{{ $task->note }}</td>
                                        <td class="table-border2 rounded text-center">
                                            <p style="margin: 0px;">
                                                {{ $task->accumulated_hours == null ? 0 : $task->accumulated_hours }} /
                                                {{ $task->number_of_sa * 90 }}</p>
                                        </td>
                                        <td class="table-border2 rounded text-center">
                                            <a href="{{ route('sa.manager.saListDone', $task->task_id) }}"
                                                class="btn btn-warning fw-bold">
                                                View # SA
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                @if (!$taskFound && $loop->last)
                                    <tr>
                                        <td class="table-border2 rounded text-center" colspan="8"><strong> No Task
                                                Available </strong></td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    @include('nav.offcanvas_menu_sam')
@endsection
