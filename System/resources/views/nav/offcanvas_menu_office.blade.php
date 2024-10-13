<div class="offcanvas offcanvas-start border-nav-right" tabindex="-1" id="offcanvas-1">
    <div class="offcanvas-header border-bottom text-end">
        <h5 class="offcanvas-title w-100 pe-2 text-accent2">{{ Auth::user()->username }}<br> <em
                class="fw-smaller">{{ Auth::user()->email }}</em></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mt-2">
        <div class="mb-3 text-start">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('office.dashboard') }}">
                    <i class="fs-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                            <path fill="currentColor"
                                d="M17.28 8.72a.75.75 0 0 1 0 1.06l-2 2a.75.75 0 0 1-1.06 0l-1-1a.75.75 0 1 1 1.06-1.06l.47.47l1.47-1.47a.75.75 0 0 1 1.06 0m0 6.56a.75.75 0 1 0-1.06-1.06l-1.47 1.47l-.47-.47a.75.75 0 1 0-1.06 1.06l1 1a.75.75 0 0 0 1.06 0zM7 10.25a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 0 1.5h-3.5a.75.75 0 0 1-.75-.75M7.75 15a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5zm8.236-11a2.25 2.25 0 0 0-2.236-2h-3.5a2.25 2.25 0 0 0-2.236 2H6.25A2.25 2.25 0 0 0 4 6.25v13.5A2.25 2.25 0 0 0 6.25 22h11.5A2.25 2.25 0 0 0 20 19.75V6.25A2.25 2.25 0 0 0 17.75 4zM10.25 6.5h3.5c.78 0 1.467-.397 1.871-1h2.129a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H6.25a.75.75 0 0 1-.75-.75V6.25a.75.75 0 0 1 .75-.75h2.129c.404.603 1.091 1 1.871 1m0-3h3.5a.75.75 0 0 1 0 1.5h-3.5a.75.75 0 0 1 0-1.5" />
                        </svg>
                    </i>
                    Tasks</a>
            </span>
        </div>
        <div class="mb-3 text-start">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('office.history') }}">
                    <i class="fs-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M6.865 6.882A7.25 7.25 0 1 1 4.75 12a.75.75 0 0 0-1.5 0a8.75 8.75 0 1 0 2.552-6.176a1 1 0 0 0-.07.08L4.475 4.646a.5.5 0 0 0-.852.309L3.27 8.844a.5.5 0 0 0 .543.543l3.89-.354a.5.5 0 0 0 .307-.851L6.782 6.954a1 1 0 0 0 .083-.072" />
                            <path fill="currentColor"
                                d="M12.75 7a.75.75 0 0 0-1.5 0v5a.75.75 0 0 0 .352.636l3 1.875a.75.75 0 1 0 .796-1.272l-2.648-1.655z" />
                        </svg>
                    </i>
                    History</a>
            </span>
        </div>
        <!--<div style="margin: 5px;padding: 5px;">
                    <span style="width: 100%;">
                    <a href="{{ route('report.saReport') }}" style="padding: 5px;color: rgb(0,0,0);font-weight: bold;">SA Reports</a></span>
                </div>
                <div style="margin: 5px;padding: 5px;">
                    <span style="width: 100%;">
                    <a href="{{ route('report.officeReport') }}" style="padding: 5px;color: rgb(0,0,0);font-weight: bold;">Office Reports</a></span>
                </div>-->
        <form class="mt-3 pt-3 border-top" action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn text-accent2 background-accent1 fw-bolder w-100 shadow" type="submit">Logout</button>
        </form>
    </div>
</div>
