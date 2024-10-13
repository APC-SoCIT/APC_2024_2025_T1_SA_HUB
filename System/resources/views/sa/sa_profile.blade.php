@extends('layouts.app')

@section('title', 'Profile - Student Assistant')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background p-4 py-0 ">
        <div class="mt-3">
            <div class="pb-3 pt-2 border-bottom-accent2 row" style="padding: 3em;">
                <div class="col-2 ">
                    <img class="img float-end" src="https://placehold.co/200" alt="">
                </div>
                <div class="col">
                    {{-- @foreach ($userProfiles as $userProfile) --}}
                    <div class="d-lg-flex align-items-lg-center mt-2">
                        <p class="d-lg-flex  h4" style="font-weight: bold;">&nbsp; Name :&nbsp;</p>
                        <p class="mb-0">{{ $userProfiles->first_name }} {{ $userProfiles->middle_initial }}.
                            {{ $userProfiles->last_name }}</p>
                    </div>
                    <div class="d-lg-flex align-items-lg-center">
                        <p class="d-lg-flex  h4" style="font-weight: bold;">&nbsp; Student ID :&nbsp;</p>
                        <p class="mb-0">{{ Auth::user()->id_number }}</p>
                    </div>
                    <div class="d-lg-flex  align-items-lg-center">
                        <p class="d-lg-flex h4" style="font-weight: bold;">&nbsp; Program :&nbsp;</p>
                        <p class="mb-0">{{ $userProfiles->course_program }}</p>
                    </div>
                    <div class="d-lg-flex  align-items-lg-center">
                        <p class="d-lg-flex h4" style="font-weight: bold;">&nbsp; Contact Details :&nbsp;</p>
                        <p class="mb-0">{{ Auth::user()->email }} | +{{ $userProfiles->contact_number }}</p>
                    </div>
                    {{-- @endforeach --}}
                </div>
            </div>

            <div class="px-3">
                <section>
                    <div class="background-accent1 py-2 border-accent2 rounded mb-3 d-xl-flex justify-content-xl-center align-items-xl-center mt-4">
                        <h2 class="text-accent2 mb-0">Class Schedule</h2>
                    </div>
                    <h6 style="text-align: center;margin-bottom: 0px;">SY {{ $term }} Term 1</h6>
                    <div class="table-responsive" style="padding: 1em;">
                        <table class="table table-hover table-border rounded">
                            <thead class="background-accent1">
                                <tr>
                                    <th class="table-border2 rounded">Subject</th>
                                    <th class="table-border2 rounded">Section</th>
                                    <th class="table-border2 rounded">Day</th>
                                    <th class="table-border2 rounded">Time</th>
                                    <th class="table-border2 rounded">Instructor</th>
                                </tr>
                            </thead>
                            <tbody class="background-accent3">
                                @forelse($schedule as $class)
                                    @php
                                        $timeDay = json_decode($class->time_constraints, true);
                                    @endphp

                                    <tr class="text-center">
                                        <td class="table-border2 rounded" data-label="Subject Code"
                                            aria-label="Subject Code">
                                            {{ $class->subject_code }}</td>
                                        <td class="table-border2 rounded" data-label="Section" aria-label="Section">
                                            {{ $class->section }}</td>
                                        <td class="table-border2 rounded" data-label="Day" aria-label="Day">
                                            @foreach($timeDay['days'] as $day)
                                                {{$day}}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                            {{-- {{ $timeDay['days'][0] }}</td> --}}
                                        <td class="table-border2 rounded" data-label="Time" aria-label="Time">
                                            @php
                                                $startTime = \Carbon\Carbon::parse($timeDay['time_start']);
                                                $endTime = \Carbon\Carbon::parse($timeDay['time_end']);
                                            @endphp
                                            {{ $startTime->format('h:ma') }} - {{ $endTime->format('h:ma') }}</td>
                                        <td class="table-border2 rounded" data-label="Instructor" aria-label="Instructor">
                                            {{ $class->instructors }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td class="table-border2 rounded fw-bold" colspan="5">No Schedule Yet</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </section>
            </div>
            <hr>
            <div class="px-3">
                <section>
                    <div class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center mt-4">
                        <h2 class="text-accent2 mb-0">Task History</h2>
                    </div>
                    <h6 style="text-align: center;margin-bottom: 0px;">
                        @foreach ($rendered as $render)
                            @if (empty($render->total_hours) && $render->total_hours === null)
                                0
                            @else
                                {{ $render->total_hours }}
                            @endif
                        @endforeach
                        / {{ $taskHistories->total() * 90 }} Hour(s) Rendered
                    </h6>
                    <div class="table-responsive" style="padding: 1em;">
                        <table class="table table-hover table-border rounded">
                            <thead>
                                <tr class="text-center align-items-center background-accent1 ">
                                    <th class="table-border2 rounded">Task no.</th>
                                    <th class="table-border2 rounded">Time &amp; Date </th>
                                    <th class="table-border2 rounded">Time-In</th>
                                    <th class="table-border2 rounded">Time-Out</th>
                                    <th class="table-border2 rounded">Hours Rendered</th>
                                    <th class="table-border2 rounded">Program </th>
                                    <th class="table-border2 rounded">Task</th>
                                    <th class="table-border2 rounded">Office</th>
                                    <th class="table-border2 rounded">Note</th>
                                    <th class="table-border2 rounded">Latest Feedback</th>
                                </tr>
                            </thead>
                            <tbody class="background-accent3">
                                @forelse($taskHistories as $taskHistory)
                                    @php
                                        $startTime = \Carbon\Carbon::parse($taskHistory->start_time);
                                        $endTime = \Carbon\Carbon::parse($taskHistory->end_time);
                                    @endphp
                                    <tr class="text-center">
                                        <td class="table-border2 rounded" data-label="Task No." scope="row">
                                            {{ $taskHistory->id }}</td>
                                        <td class="table-border2 rounded" data-label="Date &amp; Time">
                                            {{ $taskHistory->start_date }}
                                            <p class="m-0" style="font-size: 9px">
                                                {{ $startTime->format('h:ma') }} - {{ $endTime->format('h:ma') }}
                                            </p>
                                        </td>
                                        <td class="table-border2 rounded" data-label="Time In">
                                            {{ $taskHistory->time_in ?? 'No Time-In Yet' }}
                                        </td>
                                        <td class="table-border2 rounded" data-label="Time Out">
                                            {{ $taskHistory->time_out ?? 'No Time-Out Yet' }}
                                        </td>
                                        <td class="table-border2 rounded" data-label="Total Hours">
                                            {{ $taskHistory->total_hours ?? 'No Rendered Hrs' }}
                                        </td>
                                        <td class="table-border2 rounded" data-label="Program">
                                            {{ $taskHistory->preffred_program }}</td>
                                        <td class="table-border2 rounded" data-label="Task">{{ $taskHistory->to_be_done }}
                                        </td>
                                        <td class="table-border2 rounded" data-label="Office">
                                            {{ $taskHistory->assigned_office }}</td>
                                        <td class="table-border2 rounded" data-label="Note">{{ $taskHistory->note }}</td>
                                        <td class="table-border2 rounded" data-label="Feedback">
                                            {{ $taskHistory->feedback ?? 'No Feedback' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td class="table-border2 rounded" colspan="10"><strong>No Pending Task/s</strong>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                            </tbody>
                        </table>
                        <div>
                            {{ $taskHistories->onEachSide(5)->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    @include('nav.offcanvas_menu_sa')
@endsection
