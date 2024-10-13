@extends('layouts.app')

@section('title', 'SA Reports - Student Assistant Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="main-background text-center" >

        <section>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
            <div class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center mt-4">
                <h2 class="text-accent2 mb-0">Office Reports</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-border rounded">
                    <thead class="background-accent1">
                        <tr>
                            <th class="table-border2 rounded">Office</th>
                            <th class="table-border2 rounded">Number of Added Tasks</th>
                            <th class="table-border2 rounded">Number of SA Assigned</th>
                            <th class="table-border2 rounded">Hours Rendered</th>
                        </tr>
                    </thead>
                    <tbody class="background-accent3 align-items-center">
                        @if ($officeLists->count() == 0)
                            <tr>
                                <td class="table-border2 rounded text-center" colspan="4"><strong> No On-Going SA with
                                        Task </strong></td>
                            </tr>
                        @else
                            @foreach ($officeLists as $task)
                                <tr>
                                    <td class="table-border2 rounded text-center">{{ $task->faculty }}</td>
                                    <td class="table-border2 rounded text-center">{{ $task->total_tasks_posted }}</td>
                                    <td class="table-border2 rounded text-center">{{ $task->total_accepted_sa }}</td>
                                    <td class="table-border2 rounded text-center">{{ $task->total_rendered_hours }} hrs</td>
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
