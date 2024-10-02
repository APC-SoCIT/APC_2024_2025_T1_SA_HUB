<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-1">
    <div class="offcanvas-header border-bottom text-end">
        <h5 class="offcanvas-title w-100 pe-2 text-accent2">{{ Auth::user()->username }} - (Office) <br> <em
                class="fw-smaller">{{ Auth::user()->email }}</em></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mt-2">
        <div class="mb-3 text-start">
            <span class="w-100">
                <a class="btn text-accent2 fw-bold" href="{{ route('office.dashboard') }}">Tasks</a>
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
