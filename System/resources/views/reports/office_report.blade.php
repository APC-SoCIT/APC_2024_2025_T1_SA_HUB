@extends('layouts.app')

@section('title', 'SA Reports - Student Assistant Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')
    <div class="text-center" style="padding: 3em;">
            
            <section>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </div>
                @endif
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="table-warning">
                                <th scope="col">Office</th>
                                <th scope="col">Number of Added Tasks</th>
                                <th scope="col">Number of SA Assigned</th>
                                <th>Hours Rendered</th>
                            </tr>
                        </thead>
                        
                            <tbody>
                                @if($officeLists->count() == 0)
                                    <tr>
                                            <td data-label="Attributes" scope="row" colpan="6"><strong> None </strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>                                        
                                    </tr>
                                @else
                                    @foreach($officeLists as $task)
                                    <tr>
                                        <td data-label="{{$task->faculty}}" scope="row">{{$task->faculty}}</td>
                                        <td data-label="{{$task->total_tasks_posted}}">{{$task->total_tasks_posted}}</td>
                                        <td data-label="{{$task->total_accepted_sa}}">{{$task->total_accepted_sa}}</td>
                                        <td data-label="{{$task->total_rendered_hours}}">{{$task->total_rendered_hours}}</td>
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