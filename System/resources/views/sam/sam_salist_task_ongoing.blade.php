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
                                    <td class="table-border2 rounded text-center">{{ $saList->first_name }}
                                        {{ $saList->last_name }}</td>
                                    <td class="table-border2 rounded text-center">{{ $saList->course_program }}</td>
                                    <td class="table-border2 rounded text-center">
                                        {{ $saList->timein == null ? 'No Time-In Yet' : $saList->timein }}
                                    </td>

                                    <td class="table-border2 rounded text-center">
                                        {{ $saList->timeout == null ? 'No Time-Out Yet' : $saList->timeout }}
                                    </td>

                                    <td class="table-border2 rounded text-center">
                                        {{ $saList->total_hours <= 0 ? 'Not Yet Started' : $saList->total_hours . ' Hr(s)' }}
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        {{ $saList->feedback ? $saList->feedback : 'No Feedback' }}
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        <button class="btn background-accent1 {{ $saList->timeout ? '' : 'disable' }}"
                                            type="button" data-bs-toggle="modal"
                                            data-bs-target="#editHoursModal-{{ $saList->timelogId }}">
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
