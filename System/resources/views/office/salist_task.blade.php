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
        <div>
            <section>
                <div
                    class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center">
                    <h3 class="text-accent2">Task {{ $taskId }} Review</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-border rounded">
                        <thead class="background-accent1">
                            <tr>
                                <th class="table-border2 rounded">Student No.</th>
                                <th class="table-border2 rounded">SA Name</th>
                                <th class="table-border2 rounded">Program</th>
                                <th class="table-border2 rounded">Time In</th>
                                <th class="table-border2 rounded">Time Out</th>
                                <th class="table-border2 rounded">Hours</th>
                                <th class="table-border2 rounded">Feedback</th>
                            </tr>
                        </thead>
                        <tbody class="background-accent3 align-items-center">
                            @if ($saLists->isEmpty())
                                <tr>
                                    <td class="table-border rounded text-center" colspan="8"><strong> No Student
                                            Assistant Available
                                        </strong></td>
                                </tr>
                            @else
                                @foreach ($saLists as $saList)
                                    {{-- @dd($saList) --}}
                                    <tr>
                                        @php
                                            $time_in = \Carbon\Carbon::parse($saList->time_in);
                                            $time_out = \Carbon\Carbon::parse($saList->time_out);
                                        @endphp
                                        <td class="table-border2 rounded text-center">{{ $saList->user_id }}</td>
                                        <td class="table-border2 rounded text-center">
                                            {{ $saList->user->saProfile->first_name }}
                                            {{ $saList->user->saProfile->last_name }}
                                        </td>
                                        <td class="table-border2 rounded text-center">
                                            {{ $saList->user->saProfile->course_program }}
                                        </td>
                                        <td class="table-border2 rounded text-center">
                                            @if ($time_in == null)
                                                No Time-In Yet
                                            @else
                                                {{ $time_in->format('h:i a') }}
                                            @endif
                                        </td>
                                        <td class="table-border2 rounded text-center">
                                            @if ($time_out == null)
                                                No Time-Out Yet
                                            @else
                                                {{ $time_out->format('h:i a') }}
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
                                            <button
                                                class="btn {{ $saList->timeout ? 'background-accent2 text-accent1' : 'background-accent1 text-accent2 ' }}"
                                                type="button" data-bs-toggle="modal"
                                                data-bs-target="#feedbackModal-{{ $saList->timelogId }}"
                                                {{ $saList->time_out ? ' ' : 'disabled' }}>
                                                {{ $saList->time_out ? 'Add/Edit Feedback' : 'Finish Task First' }}
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
