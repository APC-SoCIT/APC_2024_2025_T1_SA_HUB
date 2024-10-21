@extends('layouts.app')

@section('title', 'Scholarship Probation - Student Assistant Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background text-center">

        <section>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
            <div
                class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center mt-4">
                <h2 class="text-accent2 mb-0">Probation</h2>
            </div>
            <div class="text-center d-flex justify-content-center">
                <a href="{{ route('sa.manager.probation.add') }}"
                    class="btn w-100 background-accent2 text-accent1 px-5 py-2 fs-5 my-2 d-flex align-items-center justify-content-center">
                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                        viewBox="0 0 16 16" class="bi bi-plus-lg" style="width: 20px;height: 20px;">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z">
                        </path>
                    </svg>
                    Add Major Offense
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-border rounded">
                    <thead class="background-accent1">
                        <tr>
                            <th class="table-border2 rounded">Name</th>
                            <th class="table-border2 rounded">Reason</th>
                            <th class="table-border2 rounded">Start Date</th>
                            <th class="table-border2 rounded">End Date</th>
                        </tr>
                    </thead>
                    <tbody class="background-accent3 align-items-center">
                        @if ($probationList->count() == 0)
                            <tr>
                                <td class="table-border2 rounded text-center" colspan="4">
                                    <strong>
                                        No SA w/ Offense
                                    </strong>
                                </td>
                            </tr>
                        @else
                            @foreach ($probationList as $task)
                                <tr>
                                    <td class="table-border2 rounded text-center">
                                        {{ $task->saProfile->first_name }}
                                        {{ $task->saProfile->last_name }}
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        Major Offense ({{ $task->description }})
                                        {{-- @foreach ($task->offenses as $offense)
                                            {{ $offense->description }}
                                            @if ($offense->type == 'grade')
                                                (Grade)
                                            @elseif($offense->type == 'major')
                                               (Major Offense)
                                            @endif
                                            @if (!$loop->last)
                                                <hr class="m-0">
                                            @endif
                                        @endforeach --}}
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        @if ($task->date_start == null)
                                            No Start Date
                                        @else
                                            @php
                                                $startDate = Carbon\Carbon::parse($task->date_start);
                                            @endphp
                                            {{ $startDate->format('M.d.Y') }}
                                        @endif

                                        {{-- @foreach ($task->offenses as $date)
                                            @php
                                                $startedDate = Carbon\Carbon::parse($date->date_start);
                                            @endphp
                                            {{ $startedDate->format('M.d.Y') }}
                                            @if (!$loop->last)
                                                <hr class="m-0">
                                            @endif
                                        @endforeach --}}
                                    </td>
                                    <td class="table-border2 rounded text-center">
                                        @if ($task->date_end == null)
                                            No End date
                                        @else
                                            @php
                                                $endDate = Carbon\Carbon::parse($task->date_end);
                                            @endphp
                                            {{ $endDate->format('M.d.Y') }}
                                        @endif

                                        {{-- @foreach ($task->offenses as $date)

                                            {{ $endDate->format('M.d.Y') }}
                                            @if (!$loop->last)
                                                <hr class="m-0">
                                            @endif
                                        @endforeach --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
        @include('nav.offcanvas_menu_sam')
    </div>
@endsection
