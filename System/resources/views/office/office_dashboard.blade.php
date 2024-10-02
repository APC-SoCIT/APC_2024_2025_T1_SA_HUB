@extends('layouts.app')

@section('title', 'Dashboard - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background">
        <section class="pt-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible show mx-5 m-auto" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
            @if (session('success_delete'))
                <div class="alert alert-danger alert-dismissible show mx-5 m-auto" role="alert">
                    {{ session('success_delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
                <h1 class="text-accent2 text-center">Student Assistant Tasks</h1>
                {{-- <hr class="border-accent2 rounded w-100 m-auto mb-3" style="opacity: .75;"> --}}
            <div class="table-responsive mx-5 mb-0" style="padding: 1em;">
                <table class="table table-hover table-border rounded">
                    <thead class="background-accent1">
                        <tr>
                            <th class="table-border2 rounded">Task No.</th>
                            <th class="table-border2 rounded">Date &amp; Time</th>
                            <th class="table-border2 rounded">Program</th>
                            <th class="table-border2 rounded">Task</th>
                            <th class="table-border2 rounded">Hours</th>
                            <th class="table-border2 rounded">Note</th>
                            <th class="table-border2 rounded">Task Accepts</th>
                            <th class="table-border2 rounded">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="background-accent3 align-items-center">

                        @if (empty($tasksWithInfo))
                            <tr>
                                <td class="table-border rounded text-center" colspan="8"><strong> No Task Available
                                    </strong></td>
                            </tr>
                        @else
                            @foreach ($tasksWithInfo as $task)
                                <tr>
                                    <td class="table-border2 rounded text-center">{{ $task->id }}</td>
                                    <td class="table-border2 rounded text-center">
                                        <div>
                                            <div>{{ $task->start_date }}</div>
                                            <div style="font-size: 11px">{{ $task->startTimeFormatted }} -
                                                {{ $task->endTimeFormatted }}</div>
                                        </div>
                                    </td>
                                    <td class="table-border2 rounded text-center">{{ $task->preffred_program }}</td>
                                    <td class="table-border2 rounded text-center">{{ $task->to_be_done }}</td>
                                    <td class="table-border2 rounded text-center">{{ $task->totalHours }}</td>
                                    <td class="table-border2 rounded text-center">{{ $task->note }}</td>
                                    <td class="table-border2 rounded text-center">
                                        <a href="{{ route('office.saList', $task->id) }}"
                                            class="btn w-100
                                        @if ($task->saCount < $task->number_of_sa) btn-success
                                        @elseif ($task->saCount = $task->number_of_sa)
                                            btn-danger @endif
                                        ">
                                            @if ($task->saCount < $task->number_of_sa)
                                                {{ $task->saCount }} /{{ $task->number_of_sa }}
                                            @elseif ($task->saCount = $task->number_of_sa)
                                                Full
                                            @endif

                                        </a>
                                    </td>

                                    <td class="table-border2 rounded">
                                        <div class="input-group row align-items-center m-auto">
                                            <a class="btn btn-primary col"
                                                href="{{ route('office.edit', $task->id) }}">Edit</a>
                                            <button class="btn btn-danger col" data-bs-toggle="modal"
                                                data-bs-target="#deleteTaskModal-{{ $task->id }}">Delete</button>

                                        </div>
                                        @include('modals.delete_task')
                                    </td>
                                    {{-- @include('modals.edit_task') --}}

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
        <div class="text-center d-flex justify-content-center">
            <a class="btn background-accent2 text-accent1 w-25 py-2 d-flex align-items-center justify-content-center"
                href="{{ route('office.add.task') }}">
                <svg class="" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                    viewBox="0 0 16 16" class="bi bi-plus-lg" style="width: 20px;height: 20px;">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z">
                    </path>
                </svg>Add Task
            </a>
        </div>
    </div>
    {{-- @include('modals.add_task') --}}
    @include('nav.offcanvas_menu_office')
@endsection
