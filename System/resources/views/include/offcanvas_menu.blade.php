<div class="offcanvas offcanvas-sm offcanvas-start" tabindex="-1" id="offcanvas-1">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">*USER* - (SA)</h5><button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body w-50">
                <div>
                    <span style="width: 100%;"><a href="#" style="padding: 5px;color: rgb(0,0,0);font-weight: bold;">Tasks</a></span>
                </div>
                <div>
                    <span style="width: 100%;"><a href="#" style="padding: 5px;color: rgb(0,0,0);font-weight: bold;">Profile</a></span>
                </div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-primary" type="submit" style="background: #ffbd59;border-style: none;color: rgb(0,0,0);font-weight: bold;">Logout</button>
                </form>
            </div>
        </div>
