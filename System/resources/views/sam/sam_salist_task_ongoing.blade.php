@extends('layouts.app')

@section('title', 'SA List - SA Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="text-center" style="padding: 3em;">

    <div style="padding: 3em;">
    <div class="d-xl-flex justify-content-xl-center align-items-xl-center" style="width: 100%;height: 4em;">
        <h3>List of Student Assistant</h3>

    </div>
    @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" aria-label="Close">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
    <section>
        <div class="d-xl-flex justify-content-xl-center align-items-xl-center" style="width: 100%;height: 3em;padding: 8px;background: #d9d9d9;margin: 0px;">
            <h5 class="text-center">Task {{$taskId}}</h5>
        </div>
        <div class="table-responsive" style="padding: 1em;">
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
                    @foreach($saLists as $saList)
                        <tr>
                            <td class="table-border2 rounded text-center">{{$saList->user_id}}</td>
                            <td class="table-border2 rounded text-center">{{$saList->first_name}} {{$saList->last_name}}</td>
                            <td class="table-border2 rounded text-center">{{$saList->course_program}}</td>
                            <td class="table-border2 rounded text-center">
                                {{$saList->timein == null ? 'No Time-In Yet' : $saList->timein}}
                            </td>
                            <!--<td>
                                <button class="btn
                                    @if($saList->is_Approved_in === null)
                                        btn-danger disabled
                                    @elseif($saList->is_Approved_in === 'Approved')
                                        btn-success disabled
                                    @elseif($saList->is_Approved_in === 'Pending')
                                        btn-warning
                                    @endif
                                    dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    >

                                    @if($saList->is_Approved_in === null)
                                        No Time in Yet
                                    @elseif($saList->is_Approved_in === 'Pending')
                                        {{$saList->is_Approved_in}}
                                    @elseif($saList->is_Approved_in === 'Approved')
                                        {{$saList->is_Approved_in}}
                                    @endif
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{ route('sa.manager.saListTimeInApprove', $saList->timelogId) }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item" href="#">Approve</button>
                                        </form>
                                    </li>
                                </ul>
                            </td>-->
                            <td class="table-border2 rounded text-center">
                                {{$saList->timeout == null ? 'No Time-Out Yet' : $saList->timeout}}
                            </td>
                            <!--<td>
                                <button class="btn
                                    @if($saList->is_Approved_out === null)
                                        btn-danger disabled
                                    @elseif($saList->is_Approved_out === 'Approved')
                                        btn-success disabled
                                    @elseif($saList->is_Approved_out === 'Pending')
                                        btn-warning
                                    @endif
                                    dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    >

                                    @if($saList->is_Approved_out === null)
                                        No Time in Yet
                                    @elseif($saList->is_Approved_out === 'Pending')
                                        {{$saList->is_Approved_out}}
                                    @elseif($saList->is_Approved_out === 'Approved')
                                        {{$saList->is_Approved_out}}
                                    @endif
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                    <form action="{{ route('sa.manager.saListTimeOutApprove', $saList->timelogId) }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item" href="#">Approve</button>
                                        </form>
                                    </li>
                                </ul>


                            </td>-->

                            <td class="table-border2 rounded text-center">
                                {{ $saList->total_hours <= 0 ? 'Not Yet Started' : $saList->total_hours.' Hr(s)'}}
                            </td>
                            <td class="table-border2 rounded text-center">
                                {{ $saList->feedback ? $saList->feedback : 'No Feedback'}}
                            </td>
                            <td class="table-border2 rounded text-center">
                                <button class="btn background-accent1 {{$saList->timeout ? '' : 'disable'}}" type="button" data-bs-toggle="modal" data-bs-target="#editHoursModal-{{ $saList->timelogId }}">
                                {{$saList->timeout ? 'Edit Hour/s' : 'No Time-out'}}
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
