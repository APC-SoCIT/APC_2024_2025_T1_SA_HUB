@extends('layouts.app')

@section('title', 'Scholarship Probation - Student Assistant Manager')

@section('content')
    <div class="row">
        @include('nav.sideNav_guidance')
        <div class="col m-0 ps-0">
            @include('include.nav_bar')
            <div class="main-background text-center">

                <section>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </div>
                    @endif
                    <div
                        class="background-accent1 py-2 border-accent2 rounded mb-1 d-xl-flex justify-content-xl-center align-items-xl-center mt-4">
                        <h2 class="text-accent2 mb-0">Revoke Page</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-border rounded">
                            <thead class="background-accent1">
                                <tr>
                                    <th class="table-border2 rounded">Name</th>
                                    <th class="table-border2 rounded">Reason</th>
                                    <th class="table-border2 rounded" colspan="2"></th>
                                    {{-- <th class="table-border2 rounded">Date Ended</th> --}}
                                </tr>
                            </thead>
                            <tbody class="background-accent3 align-items-center">
                                @if ($SaLists->count() == 0)
                                    <tr>
                                        <td class="table-border2 rounded text-center" colspan="3">
                                            <strong>
                                                No SA w/ Offense
                                            </strong>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($SaLists as $sa)

                                        <tr>
                                            @php
                                        // dd($sa);
                                    @endphp
                                            <td class="table-border2 rounded text-center">
                                                {{ $sa->saProfile->first_name }}
                                                {{ $sa->saProfile->last_name }}
                                            </td>
                                            <td class="table-border2 rounded text-center">
                                                Grade {{ $sa->description }}
                                                {{-- @foreach ($sa->offenses as $offence)
                                                    {{ $offence->description }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach --}}


                                            </td>
                                            <td class="table-border2 rounded text-center">
                                                <div class="row px-3">
                                                    @if ($sa->status == 'probation')
                                                        <div class="col mb-1">
                                                            <form
                                                                action="{{ route('guidance.scholarship.probe', $sa->user_id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn w-100 {{ $sa->status == 'probation' ? 'btn-warning' : 'btn-success' }}">
                                                                    {{ $sa->status == 'probation' ? 'Cancel Probation' : 'Probe' }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="col mb-1">
                                                            <form
                                                                action="{{ route('guidance.scholarship.revoke', $sa->user_id) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Are you sure you want to revoke this scholarship?');">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger w-100">
                                                                    Revoke
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @elseif($sa->status == 'revoked')
                                                        <div class="col mb-1">
                                                            <button type="submit" class="btn btn-danger w-100" disabled>
                                                                Revoked!!
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @if (config('app.debug'))
                                                    {{-- TO BE REMOVED ON BUILD/DEPLOYMENT --}}
                                                        @php
                                                            $user = App\Models\User::where('id_number', $sa->user_id)->withTrashed()->first();
                                                            // dd($user->id);
                                                        @endphp
                                                        @if ($user->deleted_at)
                                                            <form action="{{ route('users.restore', $user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-dark">Restore
                                                                    User</button>
                                                            </form>
                                                        @endif
                                                    @endif

                                                </div>
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
        </div>
    </div>
@endsection
