@extends('layouts.app')

@section('title', 'SA List - SA Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="text-center" style="padding: 3em;">

        <div style="padding: 3em;">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" aria-label="Close">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
            <div class="d-xl-flex justify-content-xl-center align-items-xl-center" style="width: 100%;height: 4em;">
                <h3>List of Student Assistant</h3>
            </div>
            <section>
                <div class="d-xl-flex justify-content-xl-center align-items-xl-center"
                    style="width: 100%;height: 3em;padding: 8px;background: #d9d9d9;margin: 0px;">
                    <h5>Task {{ $taskId }}</h5>
                </div>
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover table-border rounded">
                        <thead class="background-accent1">
                            <tr>
                                <th class="table-border2 rounded">Student No.</th>
                                <th class="table-border2 rounded">SA Name</th>
                                <th class="table-border2 rounded">Course</th>
                                <th class="table-border2 rounded">Time In</th>
                                <th class="table-border2 rounded">Time Out</th>
                                <th class="table-border2 rounded">Rendered Hours</th>
                                <th class="table-border2 rounded">Feedback </th>
                                <th class="table-border2 rounded">Action</th>
                            </tr>
                        </thead>
                        <tbody class="background-accent3">
                            @foreach ($saLists as $saList)
                                <tr>
                                    <td class="table-border2 rounded text-center">{{ $saList->user_id }}</td>
                                    <td class="table-border2 rounded text-center">{{ $saList->first_name }}
                                        {{ $saList->last_name }}</td>
                                    <td class="table-border2 rounded text-center">{{ $saList->course_program }}</td>
                                    <td class="table-border2 rounded text-center">
                                        @if ($saList->timein == null)
                                            No Time-In Yet
                                        @else
                                            {{ $saList->timein }}
                                        @endif
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        @if ($saList->timeout == null)
                                            No Time-Out Yet
                                        @else
                                            {{ $saList->timeout }}
                                        @endif
                                    </td>

                                    <td class="table-border2 rounded text-center">
                                        @if ($saList->total_hours <= 0)
                                            Not Yet Started
                                        @else
                                            {{ $saList->total_hours }} Hr(s)
                                        @endif
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        {{ $saList->feedback ? $saList->feedback : 'No Feedback' }}
                                    </td>

                                    <td class="table-border2 rounded text-center">
                                        <button class="btn background-accent2 text-accent1 w-100" type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editHoursModal-{{ $saList->timelogId }}"
                                            {{ $saList->timeout ? '' : 'disabled' }}>
                                            {{ $saList->timeout ? 'Edit Hour/s' : 'No Time-out' }}
                                        </button>
                                        @include('modals.edit_hours')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        @include('nav.offcanvas_menu_sam')
    @endsection
