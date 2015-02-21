<!-- Fixed navbar -->
<nav class="navbar navbar-static navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle toggle-left hidden-md hidden-lg" data-toggle="sidebar" data-target=".sidebar-left">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand fontbig" href="{{ Route('home')}}">{{Config::get('custom.system.client')}}</a>
        </div>
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-top-menu-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse navbar-top-menu-collapse">
            <div class="navbar-nav nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropdown-profile">
                        <span id="nav-email">{{Auth::user()->full_name}}</span> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{Route('user.profile')}}"><i class="fa fa-user"></i> Your profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{Route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </div><!-- nav-right -->
        </div>
    </div>
</nav>