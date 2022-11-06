<style>
    .navbar-nav .dropdown-menu {
    margin-top: 14px !important;
    margin-right: -14px;
}
</style>
<nav class="navbar d-print-none">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ url('/') }}">Orgin Food Application</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">



                    {{-- <div class="btn-group mt-3">
                        <button type="button" class="btn btn-primary " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">account_circle</i>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                        </ul>
                      </div> --}}

                      <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">account_circle</i>

                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="views/profile.html"><i class="material-icons">person</i>Profile</a></li>
                            <li>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                        <button type="submit" class="btn btn-danger" href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</button>

                                </form>
                            </li>

                          </ul>
                    </li>


            </ul>
        </div>
    </div>
</nav>
