<aside class="left-sidebar with-vertical">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
            <a href="javascript:void(0)" class="text-nowrap logo-img">
                <img src="{{ url('assets/backend/images/logos/logo.png') }}" alt="logo" width="174"/>
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ baseURL('customer') }}">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Customers</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>