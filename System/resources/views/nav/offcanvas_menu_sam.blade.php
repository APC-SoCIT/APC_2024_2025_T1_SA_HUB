<div class="offcanvas offcanvas-start border-nav-end" tabindex="-1" id="offcanvas-1">
    <div class="offcanvas-header border-bottom text-end">
        <img class="img" src="https://placehold.co/50" alt="">
        <h5 class="offcanvas-title w-100 pe-2 text-accent2">{{ Auth::user()->username }}
            <em class="fw-smaller">{{ Auth::user()->email }}</em>
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mt-2 text-start">
        <div>
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('sa.manager.dashboard.ongoing') }}">
                    <i class="fs-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                            <path fill="currentColor"
                                d="M17.28 8.72a.75.75 0 0 1 0 1.06l-2 2a.75.75 0 0 1-1.06 0l-1-1a.75.75 0 1 1 1.06-1.06l.47.47l1.47-1.47a.75.75 0 0 1 1.06 0m0 6.56a.75.75 0 1 0-1.06-1.06l-1.47 1.47l-.47-.47a.75.75 0 1 0-1.06 1.06l1 1a.75.75 0 0 0 1.06 0zM7 10.25a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 0 1.5h-3.5a.75.75 0 0 1-.75-.75M7.75 15a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5zm8.236-11a2.25 2.25 0 0 0-2.236-2h-3.5a2.25 2.25 0 0 0-2.236 2H6.25A2.25 2.25 0 0 0 4 6.25v13.5A2.25 2.25 0 0 0 6.25 22h11.5A2.25 2.25 0 0 0 20 19.75V6.25A2.25 2.25 0 0 0 17.75 4zM10.25 6.5h3.5c.78 0 1.467-.397 1.871-1h2.129a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H6.25a.75.75 0 0 1-.75-.75V6.25a.75.75 0 0 1 .75-.75h2.129c.404.603 1.091 1 1.871 1m0-3h3.5a.75.75 0 0 1 0 1.5h-3.5a.75.75 0 0 1 0-1.5" />
                        </svg>
                    </i>
                    Task Status</a>
            </span>
        </div>
        <div>
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('report.saReport') }}">
                    <i class="fs-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <g fill="currentColor">
                                <path
                                    d="M25 5h-.17v2H25a1 1 0 0 1 1 1v20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h.17V5H7a3 3 0 0 0-3 3v20a3 3 0 0 0 3 3h18a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3" />
                                <path d="M23 3h-3V0h-8v3H9v6h14zm-2 4H11V5h3V2h4v3h3z" />
                                <path d="M10 13h12v2H10zm0 5h12v2H10zm0 5h12v2H10z" class="ouiIcon__fillSecondary" />
                            </g>
                        </svg>
                    </i>
                    SA Records</a>
            </span>
        </div>
        <div class="">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('report.officeReport') }}">
                    <i class="fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                            viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2">
                                <path stroke-dasharray="64" stroke-dashoffset="64" d="M13 3l6 6v12h-14v-18h8">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s"
                                        values="64;0" />
                                </path>
                                <path stroke-dasharray="14" stroke-dashoffset="14" stroke-width="1" d="M12.5 3v5.5h6.5">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.7s"
                                        dur="0.2s" values="14;0" />
                                </path>
                                <path stroke-dasharray="4" stroke-dashoffset="4" d="M9 17v-3">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.9s"
                                        dur="0.2s" values="4;0" />
                                </path>
                                <path stroke-dasharray="6" stroke-dashoffset="6" d="M12 17v-4">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.1s"
                                        dur="0.2s" values="6;0" />
                                </path>
                                <path stroke-dasharray="6" stroke-dashoffset="6" d="M15 17v-5">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.3s"
                                        dur="0.2s" values="6;0" />
                                </path>
                            </g>
                        </svg></i>
                    Office Reports
                </a>
            </span>
        </div>
        {{-- <div class="mb-3">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('sa.manager.probation') }}">Probation</a>
            </span>
        </div>
        <div class="mb-3">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('sa.manager.revoke') }}">Revoke Scholarship</a>
            </span>
        </div> --}}
        <div class="">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('sa.manager.probation') }}">
                    <i class="fs-5 bi-hourglass-split"></i> Probation</a>
            </span>
        </div>
        <div class="mb-3">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('sa.manager.revoke') }}">
                    <i class="fs-5 bi-exclamation-circle-fill"></i> Revoke Scholarship
                </a>
            </span>
        </div>
        <form class="mt-3 pt-3 border-top" action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn text-accent2 background-accent1 fw-bolder w-100 shadow" type="submit">Logout</button>
        </form>
    </div>
</div>
