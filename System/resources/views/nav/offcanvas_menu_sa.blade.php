<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-1">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">{{$user->username}} - SA</h5><button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div style="margin: 5px;padding: 5px;">
                    <span style="width: 100%;">
                        <a class="btn" href="{{ route('sa.dashboard') }}" style="padding: 5px;color: rgb(0,0,0);font-weight: bold;">Tasks</a>
                    </span>
                </div>
                <div style="margin: 5px;padding: 5px;">
                    <span style="width: 100%;">
                        <a class="btn" href="{{ route('sa.profile') }}" style="padding: 5px;color: rgb(0,0,0);font-weight: bold;">Profile</a>
                    </span>
                </div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-primary" type="submit" style="background: #ffbd59;border-style: none;color: rgb(0,0,0);font-weight: bold;">Logout</button>
                </form>
            </div>
        </div>