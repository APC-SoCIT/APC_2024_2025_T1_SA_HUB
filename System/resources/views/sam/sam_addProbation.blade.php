@extends('layouts.app')

@section('title', 'Add Major Offense - Student Assistant Manager')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background text-accent2">

        <div class="rounded border-accent1 m-auto mt-5 w-75 p-5">
            <div class="text-center mb-3">

                <div>
                    <h2>Add Offense</h2>
                </div>

                <hr class="border-accent2 rounded w-25 m-auto" style="opacity: .75;">
            </div>
            <form action="{{ route('sa.manager.probation.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-11">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bolder">Student
                                        Assistant:</label>
                                    <select class="form-select row @error('stud_id') is-invalid @enderror" name="stud_id"
                                        id="StudId" placeholder="Select a Student Assistant">
                                        <option></option>
                                        @foreach ($SaLists as $saList)
                                            <option value="{{ $saList->user_id }}">{{ $saList->first_name }}
                                                {{ $saList->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('stud_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        {{-- <div class="col-11">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bolder">Major Offense:</label>
                                    <select class="form-select @error('type') is-invalid @enderror" name="type"
                                        id="firstSelect">
                                        <option value="">Degree of Offense</option>
                                        <option value="grade">Failed Grade</option>
                                        <option value="major">Major Offense</option>
                                    </select>
                                </div>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div> --}}
                        <div class="col-11">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bolder">Major Offense:</label>
                                    <select class="form-select row @error('description') is-invalid @enderror"
                                        name="description" id="MajorOffence" placeholder="Type of Offense">
                                        <option></option>
                                        {{-- <option class="low-grade-option" style="display: none;" value="0.0">0.0</option> --}}
                                        @foreach ($OffenseLists as $offense)
                                            <option class="major-offense-option" value="{{ $offense->offense_name }}">
                                                {{ $offense->offense_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="fw-bolder">Status:</label>
                                <div class="form-check ms-3">
                                    <input class="custom-radio @error('status') is-invalid @enderror" type="radio"
                                        name="status" id="statusOption1" value="probation" selected />
                                    <label class="form-check-label" for="statusOption1">Probation</label>
                                </div>
                                <div class="form-check ms-3">
                                    <input class="custom-radio @error('status') is-invalid @enderror" type="radio"
                                        name="status" id="statusOption2" value="pending_revoke" />
                                    <label class="form-check-label" for="statusOption2">Revoke Scholarship</label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label id="dateStartLabel"
                                    class="form-label fw-bolder @error('date_start') is-invalid @enderror">
                                    Date Started
                                </label>
                                <input type="date" class="form-control" name="date_start" id="date_start"
                                    aria-describedby="helpId" placeholder="" />
                                @error('date_start')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" id="dateEndLabel"
                                    class="form-label fw-bolder @error('date_end') is-invalid @enderror">
                                    Date Ended
                                </label>
                                <input type="date" class="form-control" name="date_end" id="date_end"
                                    aria-describedby="helpId" placeholder="" />
                                @error('date_end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                            </svg>Add Offense
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('nav.offcanvas_menu_sam')
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#StudId').select2({
                placeholder: "Select a Student Assistant",
                allowClear: true
            });
            $('#MajorOffence').select2({
                placeholder: "Type of Offence",
                allowClear: true
            });
        });

        const today = new Date().toISOString().split('T')[0];
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowString = tomorrow.toISOString().split('T')[0];

        // Set the min attribute of the start date to today
        document.getElementById("date_end").setAttribute("min", tomorrowString);

        // Set the min attribute of the end date when the start date changes
        // document.getElementById("date_start").addEventListener("change", function() {
        //     const dateNowTommoroe = this.value;
        //     // Set the min for end date to the selected start date
        //     document.getElementById("date_end").setAttribute("min", startDate);
        // });

        document.addEventListener('DOMContentLoaded', function() {

            const firstSelect = document.getElementById('firstSelect');
            const secondSelect = document.getElementById('secondSelect');
            const lowGradeOptions = document.querySelectorAll('.low-grade-option');
            const majorOffenseOptions = document.querySelectorAll('.major-offense-option');

            // Get the probation and revoke radio buttons
            const probationRadio = document.getElementById('statusOption1');
            const revokeRadio = document.getElementById('statusOption2');

            // get the Date Fields
            // Get the date label fields
            const dateStartedLabel = document.getElementById('dateStartLabel');
            const dateEndedLabel = document.getElementById('dateEndLabel');
            // Get the date input fields
            const dateStarted = document.querySelector('input[name="date_start"]');
            const dateEnded = document.querySelector('input[name="date_end"]');

            // Function to enable or disable the date fields based on status
            function toggleDateFields() {
                if (probationRadio.checked) {
                    // If probation is selected, enable date fields
                    dateStartedLabel.hidden = false;
                    dateEndedLabel.hidden = false;
                    dateStarted.hidden = false;
                    dateEnded.hidden = false;
                } else {
                    // If revoke is selected, disable date fields
                    dateStartLabel.hidden = true;
                    dateEndedLabel.hidden = true;
                    dateStarted.hidden = true;
                    dateEnded.hidden = true;
                }
            }

            // Listen for changes on the radio buttons
            probationRadio.addEventListener('change', toggleDateFields);
            revokeRadio.addEventListener('change', toggleDateFields);

            // Initialize the state on page load
            toggleDateFields();

            firstSelect.addEventListener('change', function() {
                // Clear all options in the second select
                secondSelect.innerHTML = '<option selected>Type of Offense</option>'; // Reset

                if (firstSelect.value === 'grade') {
                    // Show low grade options
                    lowGradeOptions.forEach(option => {
                        option.style.display = 'block';
                        secondSelect.appendChild(option);
                    });
                } else if (firstSelect.value === 'major') {
                    // Show major offense options
                    majorOffenseOptions.forEach(option => {
                        option.style.display = 'block';
                        secondSelect.appendChild(option);
                    });
                }
            });
        });
    </script>
@endsection
