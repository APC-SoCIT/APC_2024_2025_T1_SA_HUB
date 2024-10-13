@extends('layouts.app')

@section('title', 'Dashboard - Student Assistant Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')

    <div class="text-center main-background">
        <div class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center mt-4">
            <h2 class="text-accent2 mb-0">Task Status</h2>
        </div>
        <div class="d-flex d-lg-flex justify-content-center justify-content-lg-center align-items-lg-center pt-2 px-5 pb-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" aria-label="Close">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
            <div class="row">
                <div class="col text-center mb-3">
                    <a href='{{ route('sa.manager.dashboard.ongoing') }}'
                        class="btn going background-accent2 text-accent1 border opacity">
                        <h5 class="text-uppercase fw-bold mb-0">On-going</h5>
                    </a>
                </div>
                <div class="col text-center mb-3">
                    <a href='{{ route('sa.manager.dashboard.done') }}'
                        class="btn going background-accent1 text-accent2 border text-nowrap active-going">
                        <h5 class="text-uppercase fw-bold mb-0">Completed</h5>
                    </a>
                </div>
            </div>
        </div>
        <div style="padding: 3em; border-top-style: groove;">
            <section>
                <div class="table-responsive">
                    <table class="table table-hover table-border rounded">
                        <thead class="background-accent1">
                            <tr>
                                <th class="table-border2 rounded">Task No.</th>
                                <th class="table-border2 rounded">Date &amp; Time</th>
                                <th class="table-border2 rounded">Program</th>
                                <th class="table-border2 rounded">Task</th>
                                <th class="table-border2 rounded">Office</th>
                                <th class="table-border2 rounded">Note</th>
                                <th class="table-border2 rounded">Hours</th>
                                <th class="table-border2 rounded">SA List</th>
                            </tr>
                        </thead>
                        <tbody class="background-accent3">
                            @if ($assignedTasks->isEmpty())
                                <tr>
                                    <td class="table-border2 rounded text-center" colspan="8">
                                        <strong> No Task Available </strong>
                                    </td>
                                </tr>
                            @else
                                @foreach ($assignedTasks as $task)
                                    <tr>
                                        <td class="table-border2 rounded text-center">{{ $task->task_id }}</td>
                                        <td class="table-border2 rounded text-center">
                                            <p style="margin: 0px;">{{ $task->start_date }}</p>
                                            <p class="mb-0" style="font-size: 12px;">{{ $task->start_time }} -
                                                {{ $task->end_time }}</p>
                                        </td>
                                        <td class="table-border2 rounded text-center">{{ $task->preffred_program }}</td>
                                        <td class="table-border2 rounded text-center">{{ $task->to_be_done }}</td>
                                        <td class="table-border2 rounded text-center">
                                            <p style="margin: 0px;">{{ $task->assigned_office }}</p>
                                            <p class="mb-0" style="font-size: 12px;">
                                                {{ DB::table('users')->where('users.faculty', '=', $task->assigned_office)->select('users.email')->first()->email }}
                                            </p>
                                        </td>
                                        <td class="table-border2 rounded text-center">{{ $task->note }}</td>
                                        <td class="table-border2 rounded text-center">
                                            <p class="text-nowrap" style="margin: 0px;">
                                                {{ $task->accumulated_hours == null ? 0 : $task->accumulated_hours }} /
                                                {{ $task->number_of_sa * 90 }}</p>
                                        </td>
                                        <td class="table-border2 rounded text-center">
                                            <a href="{{ route('sa.manager.saList', ['task_id' => $task->task_id, 'list' => 'completed']) }}"
                                                class="btn btn-warning fw-bold">
                                                View
                                            </a>
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

    @include('nav.offcanvas_menu_sam')
@endsection
