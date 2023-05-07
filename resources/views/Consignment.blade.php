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
                    @endcan
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('rateXML') }}" role="button" toggle="tooltip" title="Rates">
                            <i class="fa-solid fa-money-bill-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>


            <aside class="main-sidebar sidebar-dark-primary elevation-4">

                <a href="/home" class="brand-link">
                    <img src="/img/download.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <div class="sidebar">

                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/img/profile/{{ Auth::user()->photo }}" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="/profile" class="d-block">{{ Auth::user()->name }}</a>
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
                                    <a href="/home" class="nav-link">
                                        <i class="fa-solid fa-gauge-high nav-icon"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                            @endcannot
                            <li class="nav-item">
                                <a href="/delivery" class="nav-link">
                                    <i class="fa-solid fa-truck-fast nav-icon"></i>
                                    <p>Delivery</p>
                                </a>
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
                                            <a href="/staff" class="nav-link">
                                                <i class="fa-solid fa-id-card nav-icon"></i>
                                                <p>Staff</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/vehicles" class="nav-link">
                                                <i class="fa-solid fa-van-shuttle nav-icon"></i>
                                                <p>Vehicle / Assign</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/branches" class="nav-link">
                                                <i class="fa-solid fa-city nav-icon"></i>
                                                <p>Branches</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a href="/profile" class="nav-link">
                                    <i class="fa-solid fa-user nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/warehouse" class="nav-link">
                                    <i class="nav-icon fa-solid fa-warehouse"></i>
                                    <p>
                                        Warehouse
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href={{ url('receipt&Invoice') }} class="nav-link">
                                    <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                    <p>
                                        History
                                    </p>
                                </a>
                            </li>
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
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Consignment</h1>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="content" style="@media print{color: black};">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice">
                                    <div class="row">
                                        <div class="col text-left">
                                            <h1 class="document-type display-4" style="margin-right:5em">
                                                <span>TheLorry</span>
                                            </h1>
                                            <p class="mx-2"><strong>Ref. Code
                                                    <em>{{ $data->address1 ? 'P' : 'D' }}{{ date('Ymmd', strtotime($data->created_at)) }}-{{ Auth::user()->id }}</strong></em>
                                            </p>
                                        </div>
                                        <div class="col text-right">
                                            <address><strong>The Lorry Sdn.Bhd.</strong><br>
                                                Lot 8, Jalan Astaka U8/81, Bukit Jelutong Business And Technology Centre,
                                                40150 Shah Alam, Selangor, Malaysia</address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">Tracking:
                                            {{ $data->address1 ? 'PCu' : 'Drp' }}{{ date('mdy', strtotime($data->created_at)) }}{{ $data->id }}
                                        </div>
                                        <div class="col">Type: Parcel Delivery</div>
                                        <div class="col">Weight: {{ $data->weight }} KG</div>
                                        <div class="col">Date: {{ date('d M Y', strtotime($data->date)) }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col border border-dark pt-3">
                                            <div>From: {{ $data->name }}</div>
                                            <div>Phone: {{ $data->phone }}</div>
                                            <address>
                                                {{ Auth::user()->address1 }},
                                                {{ Auth::user()->address2 }},
                                                {{ Auth::user()->postcode }},
                                                {{ Auth::user()->city }},
                                                {{ Auth::user()->province }},
                                                {{ Auth::user()->country }}
                                            </address>
                                        </div>
                                        <div class="col border border-dark pt-3">
                                            <div>To: {{ $data->toname }}</div>
                                            <div>Phone: {{ $data->tophone }}</div>
                                            <address>
                                                Address:
                                                {{ $data->toaddress1 }}, {{ $data->toaddress2 }},
                                                {{ $data->topostcode }},
                                                {{ $data->tocity }}, {{ $data->toprovince }}, {{ $data->tocountry }}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row border border-dark"></div>
                                    <div class="row">
                                        <div class="col border border-dark py-3">
                                            <div class="d-flex justify-content-around">{!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(json_encode($data, JSON_PRETTY_PRINT)) !!}</div>
                                        </div>
                                        <div class="col border border-dark py-3 text-center">
                                            <div class="d-flex justify-content-center my-3">{!! DNS1D::getBarcodeHTML($data->sku, 'C39') !!}</div>
                                            <div class="d-flex justify-content-center my-3">
                                                {{ date('mdy', strtotime($data->created_at)) }}{{ $data->id }}{{ number_format($data->price, 0) }}{{ date('dmy', strtotime($data->date)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start my-3">
                                        <div class="button mx-2">
                                            <a @click="printMe" rel="noopener" target="_blank" class="btn bg-blue"><i
                                                    class="fas fa-print"></i> Print</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
