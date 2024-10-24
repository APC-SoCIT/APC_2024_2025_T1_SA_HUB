@extends('layouts.app')

@section('title', 'SA List - SA Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background text-center">

        <div>
            <div
                class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center mt-4">
                <h2 class="text-accent2 mb-0">List of Student Assistant</h2>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" aria-label="Close">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
            <section>
                <div
                    class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center">
                    <h5 class="text-accent2 mb-0">Task {{ $taskId }}</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-border rounded">
                        <thead class="background-accent1">
                            <tr>
                                <th class="table-border2 rounded">Student No.</th>
                                <th class="table-border2 rounded">SA Name</th>
                                <th class="table-border2 rounded">Course</th>
                                <th class="table-border2 rounded">Time In</th>
                                <!-- <th style="background: #d9d9d9;">Time In Status</th> -->
                                <th class="table-border2 rounded">Time Out</th>
                                <!-- <th style="background: #d9d9d9;">Time Out Status</th> -->
                                <th class="table-border2 rounded">Rendered Hours</th>
                                <th class="table-border2 rounded">Feedback</th>
                                <th class="table-border2 rounded">Action</th>
                            </tr>
                        </thead>
                        <tbody class="background-accent3">
                            @foreach ($saLists as $saList)
                                <tr>
                                    <td class="table-border2 rounded text-center">{{ $saList->user_id }}</td>
                                    <td class="table-border2 rounded text-center">
                                        @if ($status == 1)
                                            {{ $saList->first_name }}
                                            {{ $saList->last_name }}
                                        @elseif($status == 2)
                                            {{ $saList->user->saProfile->first_name }}
                                            {{ $saList->user->saProfile->last_name }}
                                        @endif
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        @if ($status == 1)
                                            {{ $saList->course_program }}
                                        @elseif($status == 2)
                                            {{ $saList->user->saProfile->course_program }}
                                        @endif
                                    </td>
                                    @php
                                        $timein = \Carbon\Carbon::parse($saList->timein);
                                        $time_in = \Carbon\Carbon::parse($saList->time_in);
                                        $timeout = \Carbon\Carbon::parse($saList->timeout);
                                        $time_out = \Carbon\Carbon::parse($saList->time_out);
                                    @endphp
                                    <td class="table-border2 rounded text-center">
                                        @if ($status == 1)
                                            {{ $saList->timein == null ? 'No Time-In Yet' : $timein->format('h:m A') }}
                                        @elseif($status == 2)
                                            {{ $saList->time_in == null ? 'No Time-In Yet' : $time_in->format('h:m A') }}
                                        @endif
                                    </td>

                                    <td class="table-border2 rounded text-center">
                                        @if ($status == 1)
                                            {{ $saList->timeout == null ? 'No Time-Out Yet' : $timeout->format('h:m A') }}
                                        @elseif($status == 2)
                                            {{ $saList->time_out == null ? 'No Time-Out Yet' : $time_out->format('h:m A') }}
                                        @endif
                                    </td>

                                    <td class="table-border2 rounded text-center">
                                        {{ $saList->total_hours <= 0 ? 'Not Yet Started' : $saList->total_hours . ' Hr(s)' }}
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        {{ $saList->feedback ? $saList->feedback : 'No Feedback' }}
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        <button
                                            class="btn background-accent1
                                            @if ($status == 1) {{ $saList->timeout ? '' : 'disable' }} @endif  "
                                            type="button" data-bs-toggle="modal"
                                            data-bs-target="#editHoursModal-{{ $saList->timelogId }}">
                                            {{-- {{ $saList->timeout ? 'Edit Hour/s' : 'No Time-out' }} --}}

                                            @if ($status == 1)
                                                {{ $saList->timeout ? 'Edit Hour/s' : 'No Time-out' }}
                                            @elseif($status == 2)
                                                {{ $saList->time_out ? 'Edit Hour/s' : 'No Time-out' }}
                                            @endif
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
