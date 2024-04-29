<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">

        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('backend/my-image/abu-beyaz-dikey.svg')}}" alt="" height="40">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('backend/my-image/abu-beyaz.svg')}}" alt="" height="40">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                @if(Auth::user()->status==2 || Auth::user()->status==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('auth.index')}}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                @endif


                @if(Auth::user()->status==2 || Auth::user()->status==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-shield-user-line"></i> <span data-key="t-dashboards">Kullanıcılar</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{route('users.create')}}" class="nav-link"><span data-key="t-job">Yeni Kullanıcı</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link" data-key="t-analytics"> Kullanıcıları Listele </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                @endif

                @if(Auth::user()->status==2 || Auth::user()->status==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('sections.index')}}">
                        <i class="bx bx-table"></i> <span data-key="t-dashboards">Bölümler</span>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#ApplicationsDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-stack-line"></i> <span data-key="t-dashboards">Apply & New Applications</span>
                    </a>
                    <div class="collapse menu-dropdown" id="ApplicationsDashboards">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{route('form.create')}}" class="nav-link"><span data-key="t-job">New Applications</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('form.index')}}" class="nav-link" data-key="t-analytics"> Applications List </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->







            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
