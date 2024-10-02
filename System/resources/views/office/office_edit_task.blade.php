@extends('layouts.app')

@section('title', 'Edit Task - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background text-accent2">

        <div class="rounded border-accent1 m-auto mt-5 w-75 p-5">
            <div class="text-center mb-3">
                <div>
                    <h2>Edit Task</h2>
                </div>
                <hr class="border-accent2 rounded w-25 m-auto" style="opacity: .75;">
            </div>
            <form action="{{ route('office.update', $task->id) }}" method="post">
                @csrf
                @method('PUT')
                <div>
                    <div class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col">
                            <div>
                                <div>
                                    <div class="row">
                                        <div class="col-11" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Date *</strong></label></div>
                                            <div>
                                                <input class="form-control w-100" id="start_date" name="start_date"
                                                    type="date" style="width: 200px;font-size: 20px;" required
                                                    value="{{ $task->start_date }}">
                                            </div>
                                        </div>
                                        <div class="col-11" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Time *</strong></label></div>
                                            <div class="row p-2">
                                                <input class="form-control col" id="start_time" name="start_time"
                                                    type="time" style="width: 150px; margin:5px;"
                                                    value="{{ $task->start_time }}">
                                                <input class="form-control col" id="end_time" name="end_time"
                                                    type="time" style="width: 150px; margin:5px;"
                                                    value="{{ $task->end_time }}">
                                            </div>

                                        </div>
                                        <div class="col-11" style="margin: 1em;">
                                            {{-- <div class="co" > --}}
                                            <div><label class="form-label"><strong>No. of Student Assistant
                                                        *</strong></label></div>
                                            <div><input class="form-control w-100 m-auto" id="number_of_sa"
                                                    name="number_of_sa" type="number" style="width: 5em;font-size: 20px;"
                                                    required value="{{ $task->number_of_sa }}">
                                            </div>

                                            {{-- </div> --}}
                                        </div>
                                        <div class="col-11 p-2" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Program </strong>(optional)</label></div>
                                            <div>
                                                <select class="form-select" id="preffred_program" name="preffred_program"
                                                    aria-label="Default select example">
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->name }}"
                                                            {{ $task->preffred_program == $course->name ? 'selected' : '' }}>
                                                            {{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <div>
                                    <div class="row">
                                        <div class="col-11" style="margin: 1em;">
                                            <div>
                                                <label class="form-label">
                                                    <strong>Task Type: </strong>*
                                                </label>
                                            </div>
                                            <div id="assignment_type" class="px-3">
                                                <div class="form-check" style="margin: auto;">
                                                    <input class="form-check-input" type="radio" name="assignment_type"
                                                        id="formCheck-3" value="1"
                                                        {{ $task->assignment_type == 1 ? 'checked' : '' }}
                                                        {{ $task->assignment_type == 2 ? '' : 'checked' }}>
                                                    <label class="form-check-label" for="formCheck-3">Auto
                                                        Assignment</label>
                                                </div>
                                                <div class="form-check" style="margin: auto;">
                                                    <input class="form-check-input" type="radio" name="assignment_type"
                                                        id="formCheck-4" value="2"
                                                        {{ $task->assignment_type == 2 ? 'checked' : '' }}
                                                        {{ $task->assignment_type == 1 ? '' : 'checked' }}>
                                                    <label class="form-check-label" for="formCheck-4">Voluntary</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-11" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Tasks to be done</strong>
                                                    (optional)</label></div>
                                            <div class="d-xl-flex align-items-xl-center">
                                                <input class="form-control w-100" id="to_be_done" name="to_be_done"
                                                    type="text" style="width: 20em;height: 5em;"
                                                    value="{{ $task->to_be_done }}">
                                            </div>
                                        </div>
                                        <div class="col-11" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Note </strong>(contact person, what to
                                                    bring, etc.)</label></div>
                                            <div class="d-xl-flex align-items-xl-center">
                                                <input class="form-control w-100" id="note" name="note"
                                                    type="text" style="width: 20em;height: 5em;"
                                                    value="{{ $task->note }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <a class="btn background-accent1 text-accent2 w-25 mx-1 py-2 d-flex align-items-center justify-content-center"
                        href="{{ url()->previous() }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor"
                            class="bi bi-arrow-left me-1" viewBox="0 0 16 16" style="width: 20px;height: 20px;">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        Back
                    </a>
                    <button
                        class="btn background-accent2 text-accent1 w-25 py-2 d-flex align-items-center justify-content-center mx-1"
                        type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                            class="bi bi-floppy me-1" viewBox="0 0 16 16" style="width: 20px;height: 20px;">
                            <path d="M11 2H9v3h2z" />
                            <path
                                d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                        </svg>
                        Update
                    </button>
                </div>
        </div>
        </form>
    </div>
    </div>
    @include('nav.offcanvas_menu_office')
@endsection
