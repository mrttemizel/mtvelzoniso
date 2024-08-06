<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
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

            <div id="two-column-menu"></div>

            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">{{ trans('sidebar.menu') }}</span>
                </li>

                @if (! auth()->user()->haveAlreadyApplication())
                    <li class="nav-item">
                        <a href="{{ route('backend.applications.create') }}" class="nav-link menu-link">
                            <i class="las la-plus-square"></i>
                            <span>{{ trans('sidebar.applications.create') }}</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('backend.applications.index') }}" class="nav-link menu-link">
                        <i class="las la-users"></i>
                        <span>{{ trans('sidebar.applications.index') }}</span>
                    </a>
                </li>

                @if (auth()->user()->isAllAdmin())
                    <li class="nav-item">
                        <a href="{{ route('backend.agencies.index') }}" class="nav-link menu-link">
                            <i class="bx bxs-business"></i>
                            <span>{{ trans('sidebar.agencies') }}</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->isAuthorized())
                    <li class="nav-item">
                        <a href="{{ route('backend.users.index') }}" class="nav-link menu-link">
                            <i class="las la-users"></i>
                            <span>{{ trans('sidebar.users') }}</span>
                        </a>
                    </li>
                @endif

{{--                @if (auth()->user()->isAllAdmin())--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('backend.email-templates.index') }}" class="nav-link menu-link">--}}
{{--                            <i class="bx bx-mail-send"></i>--}}
{{--                            <span>{{ trans('sidebar.email-template') }}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endif--}}

                @if (auth()->user()->isAllAdmin())
                    <li class="nav-item">
                        <a href="{{ route('backend.departments.index') }}" class="nav-link menu-link">
                            <i class="bx bx-table"></i>
                            <span>{{ trans('sidebar.departments') }}</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->isAllAdmin())
                    <li class="nav-item">
                        <a href="{{ route('backend.academic-years.index') }}" class="nav-link menu-link">
                            <i class="bx bx-calendar"></i>
                            <span>{{ trans('sidebar.academicYears') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>

<div class="vertical-overlay"></div>
