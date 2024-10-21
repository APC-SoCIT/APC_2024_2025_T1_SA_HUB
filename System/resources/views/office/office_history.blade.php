@extends('layouts.app')

@section('title', 'Dashboard - Office')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background">
        <section>
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
            <h1 class="text-accent2 text-center"></h1>
            <div
                class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center mt-4">
                <h2 class="text-accent2 mb-0">History</h2>
            </div>
            {{-- <hr class="border-accent2 rounded w-100 m-auto mb-3" style="opacity: .75;"> --}}
            <div class="table-responsive mb-0 py-2">
                <table class="table table-hover table-border rounded">
                    <thead class="background-accent1">
                        <tr>
                            <th class="table-border2 rounded text-center">Task No.</th>
                            <th class="table-border2 rounded text-center">Date &amp; Time</th>
                        </tr>
                    </thead>
                    <tbody class="background-accent3 align-items-center">

                        @if (empty($taskCompleted))
                            <tr>
                                <td class="table-border rounded text-center" colspan="2"><strong> No completed Available
                                    </strong></td>
                            </tr>
                        @else
                            @foreach ($taskCompleted as $task)
                                @php
                                    $time_in = \Carbon\Carbon::parse($task->time_in);
                                    $time_out = \Carbon\Carbon::parse($task->time_out);
                                @endphp
                                <tr>
                                    <td class="table-border2 rounded text-center">{{ $task->id }}</td>
                                    <td class="table-border2 rounded text-center">
                                        <div>
                                            <div>{{ $time_in->format('M.d.Y') }}</div>
                                            <div style="font-size: 11px">{{ $time_in->format('h:i a') }} -
                                                {{ $time_out->format('h:i a') }}</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    {{-- @include('modals.add_task') --}}
    @include('nav.offcanvas_menu_office')
@endsection
