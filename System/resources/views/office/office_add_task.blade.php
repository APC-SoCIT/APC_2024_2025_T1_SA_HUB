@extends('layouts.app')

@section('title', 'Dashboard - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background text-accent2">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="rounded border-accent1 m-auto mt-5 w-75 p-5">
            <div class="text-center mb-3">

                <div>
                    <h2>Add Task</h2>
                </div>

                <hr class="border-accent2 rounded w-25 m-auto" style="opacity: .75;">
            </div>
            <form action="{{ route('office.add') }}" method="POST">
                @csrf
                <div>
                    <div class="row">
                        <div class="col">
                            <div>
                                <div>
                                    <div class="row">
                                        <div class="col-11" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Date *</strong></label></div>
                                            <div><input class="form-control w-100 @error('start_date') is-invalid @enderror"
                                                    id="start_date" name="start_date" type="date"
                                                    style="width: 200px;font-size: 20px;">
                                                @error('start_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-11" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Time *</strong></label></div>
                                            <div class="row p-2">
                                                <input class="form-control col @error('start_time') is-invalid @enderror"
                                                    id="start_time" name="start_time" type="time"
                                                    style="width: 150px; margin:5px;">
                                                @error('start_time')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input class="form-control col @error('end_time') is-invalid @enderror"
                                                    id="end_time" name="end_time" type="time"
                                                    style="width: 150px; margin:5px;">
                                                @error('end_time')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-11" style="margin: 1em;">
                                            {{-- <div class="co" > --}}
                                            <div><label class="form-label"><strong>No. of Student Assistant
                                                        *</strong></label></div>
                                            <div><input
                                                    class="form-control w-100 m-auto @error('number_of_sa') is-invalid @enderror"
                                                    id="number_of_sa" name="number_of_sa" type="number"
                                                    style="width: 5em;font-size: 20px;">
                                                @error('number_of_sa')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            {{--  --}}
                                            {{-- </div> --}}
                                        </div>
                                        <div class="col-11 p-2" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Program </strong>(optional)</label></div>
                                            <div>
                                                <select class="form-select @error('preffred_program') is-invalid @enderror"
                                                    id="preffred_program" name="preffred_program"
                                                    aria-label="Default select example">
                                                    <option selected disable value="0">Select a Program</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('preffred_program')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                                                    <strong>Task Type:</strong>*
                                                </label>
                                            </div>
                                            <div id="assignment_type" class="px-3">
                                                <div class="form-check" style="margin: auto;">
                                                    <input
                                                        class="form-check-input @error('assignment_type') is-invalid @enderror"
                                                        type="radio" name="assignment_type" id="formCheck-3"
                                                        value="1">
                                                    <label class="form-check-label" for="formCheck-3">Auto
                                                        Assignment</label>
                                                </div>
                                                <div class="form-check" style="margin: auto;">
                                                    <input
                                                        class="form-check-input @error('assignment_type') is-invalid @enderror"
                                                        type="radio" name="assignment_type" id="formCheck-4"
                                                        value="2">
                                                    <label class="form-check-label" for="formCheck-4">Voluntary</label>
                                                    @error('assignment_type')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-11" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Tasks to be done</strong>
                                                    (optional)</label></div>
                                            <div class="d-xl-flex align-items-xl-center">
                                                <input class="form-control w-100 @error('to_be_done') is-invalid @enderror"
                                                    id="to_be_done" name="to_be_done" type="text"
                                                    style="width: 20em;height: 5em;">
                                                @error('to_be_done')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-11" style="margin: 1em;">
                                            <div><label class="form-label"><strong>Note </strong>(contact person, what to
                                                    bring, etc.)</label></div>
                                            <div class="d-xl-flex align-items-xl-center">
                                                <input class="form-control w-100 @error('note') is-invalid @enderror"
                                                    id="note" name="note" type="text"
                                                    style="width: 20em;height: 5em;">
                                                @error('note')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button
                        class="btn background-accent2 text-accent1 w-25 py-2 d-flex align-items-center justify-content-center"
                        type="submit">
                        <svg class="" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                            fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-lg"
                            style="width: 20px;height: 20px;">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z">
                            </path>
                        </svg>Add Task
                    </button>
                </div>
        </div>
        </form>
    </div>
    </div>
    @include('nav.offcanvas_menu_office')
@endsection
