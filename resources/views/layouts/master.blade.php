<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheLorry</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                @cannot('isCustomer')
                    <li class="nav-item d-none d-sm-inline-block">
                        <router-link to="/home" class="nav-link">Home</router-link>
                    </li>
                @endcannot
                @can('isCustomer')
                    <li class="nav-item d-none d-sm-inline-block">
                        <router-link to="/delivery" class="nav-link">Home</router-link>
                    </li>
                @endcannot

            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="rateXML" role="button" toggle="tooltip" title="Rates">
                        <i class="fa-solid fa-money-bill-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button" toggle="tooltip"
                        title="Full Screen">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4 sticky">
            @cannot('isCustomer')
                <router-link to="/home" class="brand-link">
                    <img src="/img/download.png" alt="TheLorry Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">TheLorry</span>
                </router-link>
            @endcannot
            @can('isCustomer')
                <router-link to="/delivery" class="brand-link">
                    <img src="/img/download.png" alt="TheLorry Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">TheLorry</span>
                </router-link>
            @endcan

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/img/profile/{{ Auth::user()->photo }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <router-link to="/profile" class="d-block"><h5>{{ Auth::user()->name }}</h5></router-link>
                    </div>
                </div>

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @cannot('isCustomer')
                            <li class="nav-item">
                                <router-link to="/home" class="nav-link">
                                    <i class="fa-solid fa-gauge-high nav-icon"></i>
                                    <p>Dashboard</p>
                                </router-link>
                            </li>
                        @endcannot
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <i class="fa-solid fa-truck-fast nav-icon"></i>
                                <p>Delivery</p>
                            </router-link>
                        </li>
                        @can('isAdministrator')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users-gear"></i>
                                    <p>
                                        Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/staff" class="nav-link">
                                            <i class="fa-solid fa-id-card nav-icon"></i>
                                            <p>Staff</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/vehicles" class="nav-link">
                                            <i class="fa-solid fa-van-shuttle nav-icon"></i>
                                            <p>Vehicle / Assign</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/branches" class="nav-link">
                                            <i class="fa-solid fa-city nav-icon"></i>
                                            <p>Branches</p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <router-link to="/profile" class="nav-link">
                                <i class="fa-solid fa-user nav-icon"></i>
                                <p>Profile</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/warehouse" class="nav-link">
                                <i class="nav-icon fa-solid fa-warehouse"></i>
                                <p>
                                    Warehouse
                                </p>
                                </router-li>
                        </li>
                        <li class="nav-item">
                            <a href={{ url('receipt&Invoice') }} class="nav-link">
                                <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                <p>
                                    History
                                </p>
                            </a>
                        </li>
                        @can('Administrator')
                            <li class="nav-item">
                                <a href={{ url('consignment') }} class="nav-link">
                                    <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                    <p>
                                        Consignment
                                    </p>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-power-off nav-icon red"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">
            <router-view :profile="{{ Auth::user() }}"></router-view>
        </div>


        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>



    <script src="/js/app.js" defer></script>
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>

</html>
