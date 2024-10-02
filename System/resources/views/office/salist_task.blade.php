@extends('layouts.app')

@section('title', 'SA List - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background text-center" style="padding: 3em;">
        <section>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" aria-label="Close">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
        </section>
        <div style="padding: 3em;">

            <section>
                <div class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center"
                    >
                    <h3 class="text-accent2">Task {{ $taskId }} Review</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-border rounded">
                        <thead class="background-accent1">
                            <tr>
                                <th class="table-border2 rounded">Student No.</th>
                                <th class="table-border2 rounded">SA Name</th>
                                <th class="table-border2 rounded">Course</th>
                                <th class="table-border2 rounded">Latest Time In</th>
                                <th class="table-border2 rounded">Latest Time Out</th>
                                <th class="table-border2 rounded">Hours Rendered</th>
                                <th class="table-border2 rounded">Feedback</th>
                            </tr>
                        </thead>
                        <tbody class="background-accent3 align-items-center">

                            @if ($saLists->isEmpty())
                                <tr>
                                    <td class="table-border rounded text-center" colspan="8"><strong> No Student Assistant Available
                                        </strong></td>
                                </tr>
                            @else
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
                                            <button class="btn {{ $saList->timeout ? 'btn-info' : 'btn-warning ' }}"
                                                type="button"
                                                style="font-size: 12px;color: rgb(0,0,0);font-weight: bold;border-style: none;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#feedbackModal-{{ $saList->timelogId }}"
                                                {{ $saList->timeout ? ' ' : 'disabled' }}>
                                                {{ $saList->timeout ? 'Add/Edit Feedback' : 'Finish Task First' }}
                                            </button>
                                            @include('modals.feedback')
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        @include('nav.offcanvas_menu_office')
    @endsection
