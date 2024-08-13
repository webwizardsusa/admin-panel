@php
    $user = auth()->user();
    $name = $user->name;
    $email = $user->email;
    $image = $user->image != '' && fileExists(url('storage/profile/'.$user->image)) ? url('storage/profile/'.$user->image) : url('assets/backend/images/profile/user.jpg');
@endphp

<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin</title>

        <link rel="shortcut icon" type="image/png" href="{{ url('assets/backend/images/logos/favicon.png') }}" />
        <link rel="stylesheet" href="{{ url('assets/backend/css/styles.css') }}" />
        @stack('styles')
        <link rel="stylesheet" href="{{ url('assets/backend/css/custom.css') }}" />
    </head>
    <body class="link-sidebar">
        <div class="preloader">
            <img src="{{ url('assets/backend/images/logos/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
        </div>
        <div id="main-wrapper">
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
            <div class="page-wrapper">
                <header class="topbar">
                    <div class="with-vertical">
                        <nav class="navbar navbar-expand-lg p-0">
                            <ul class="navbar-nav">
                                <li class="nav-item nav-icon-hover-bg rounded-circle ms-n2">
                                    <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                                        <i class="ti ti-menu-2"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="d-block d-lg-none py-4">
                                <a href="javascript:void(0)" class="text-nowrap logo-img">
                                    <img src="{{ url('assets/backend/images/logos/logo.png') }}" alt="logo" width="145"/>
                                </a>
                            </div>
                            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                <li class="nav-item nav-icon-hover-bg rounded-circle">
                                    <a class="nav-link moon dark-layout" href="javascript:void(0)">
                                        <i class="ti ti-moon moon"></i>
                                    </a>
                                    <a class="nav-link sun light-layout" href="javascript:void(0)">
                                        <i class="ti ti-sun sun"></i>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="user-profile-img">
                                                <img src="{{ $image }}" class="rounded-circle" width="35" height="35" alt="profile" />
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                                        <div class="profile-dropdown position-relative" data-simplebar>
                                            <div class="py-3 px-7 pb-0">
                                                <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                            </div>
                                            <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                <img src="{{ $image }}" class="rounded-circle" width="80" height="80" alt="profile" />
                                                <div class="ms-3">
                                                    <h5 class="mb-1 fs-3">{{ $name }}</h5>
                                                    <p class="mb-0 d-flex align-items-center gap-2">
                                                        <i class="ti ti-mail fs-4"></i> {{ $email }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="message-body">
                                                <a href="{{ baseURL('profile') }}" class="py-8 px-7 mt-8 d-flex align-items-center">
                                                    <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                                        <img src="{{ url('assets/backend/images/svgs/icon-account.svg') }}" alt="modernize-img" width="24" height="24" />
                                                    </span>
                                                    <div class="w-100 ps-3">
                                                        <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                                                        <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-grid py-4 px-7 pt-8">
                                                <a href="javascript:void(0);" class="btn btn-outline-primary logout" data-url="{{ baseURL('logout') }}">Log Out</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </header>
                <div class="body-wrapper">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ url('assets/backend/js/vendor.min.js') }}"></script>
        <script src="{{ url('assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
        <script src="{{ url('assets/backend/plugins/theme/js/app.init.js') }}"></script>
        <script src="{{ url('assets/backend/plugins/theme/js/theme.js') }}"></script>
        <script src="{{ url('assets/backend/plugins/theme/js/app.min.js') }}"></script>
        <script src="{{ url('assets/backend/plugins/theme/js/sidebarmenu.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
        @stack('scripts')

        <script>
            $('.logout').click(function() {
                var form = $('{{ html()->form("post", "")->open() }}{{ html()->form()->close() }}').appendTo('body');
                form.attr('action', $(this).data('url')).submit();
            })
        </script>
    </body>
</html>