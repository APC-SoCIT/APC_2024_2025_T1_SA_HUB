<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-1">
    <div class="offcanvas-header border-bottom text-end">
        <img class="img" src="https://placehold.co/50" alt="">
        <h5 class="offcanvas-title w-100 pe-2 text-accent2">{{ Auth::user()->username }} - (SAM)
            <em class="fw-smaller">{{ Auth::user()->email }}</em>
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mt-2 text-start">
        <div>
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('sa.manager.dashboard.ongoing') }}">Tasks</a>
            </span>
        </div>
        <div>
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('report.saReport') }}">SA Reports</a>
            </span>
        </div>
        <div class="mb-3">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('report.officeReport') }}">Office Reports</a>
            </span>
        </div>
        <form class="mt-3 pt-3 border-top" action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn text-accent2 background-accent1 fw-bolder w-100 shadow" type="submit">Logout</button>
        </form>
    </div>
</div>
