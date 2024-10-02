<div class="col-auto col-md-2 px-sm-3 px-0 border-end sticky-top sticky-offset border vh-100 overflow-auto">
    <div class="flex-column align-items-center align-items-sm-start ps-3 pt-2 text-white">
        <div class="text-end">
            <div class="row flex-column align-items-center border-bottom pb-1">
                <img class="img-fluid col-5 p-0" src="https://placehold.co/50" alt="">
                <div class="col-12">
                    <div class="row text-center">
                        <h4 class="w-100 text-accent2 mb-0">{{ Auth::user()->username }}</h4>
                        <p class="fw-smaller text-accent2 mb-0" style="font-size: 11px;">{{ Auth::user()->email }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
            id="menu">

            <li class="nav-item">
                <a href="{{ route('guidance.dashboard')}}" class="nav-link align-middle px-0 text-accent2">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('guidance.dashboard')}}" class="nav-link align-middle px-0 text-accent2">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Probation</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('guidance.dashboard')}}" class="nav-link align-middle px-0 text-accent2">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Scholarship</span>
                </a>
            </li>
    </div>
    {{-- LOGOUT --}}
    <div>
        <form class="mt-2 pt-3" action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn text-accent2 background-accent1 fw-bolder w-100 shadow"
                type="submit">Logout</button>
        </form>
    </div>
</div>
