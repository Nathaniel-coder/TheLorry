<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheLorry</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="public/css/pagination.css">


    <!-- Latest compiled and minified CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
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

            @cannot('isCustomer')
                <a href="/home" class="brand-link">
                    <img src="/img/download.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>
            @endcannot
            @can('isCustomer')
                <a href="/delivery" class="brand-link">
                    <img src="/img/download.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>
            @endcan


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
                            <h1>Receipts and Invoices</h1>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row d-flex justify-content-around" style="margin-left: 0; margin-right: 0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link" href="#pickUp" data-toggle="tab">Pick Up</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#dropOff" data-toggle="tab">Drop Off</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="dropOff">
                                    <div class="post">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    Drop Off
                                                </h3>
                                                <div class="card-tools">
                                                    <a href="DAXML" type="button" class="btn btn-tool bg-purple"
                                                        toggle="tooltip" title="Generate XML">
                                                        <i class="fa-solid fa-file-code text-white"></i>
                                                    </a>
                                                    <a href="dropCSV" type="button" class="btn btn-tool bg-green"
                                                        toggle="tooltip" title="Download CSV">
                                                        <i class="fa-solid fa-file-excel text-white"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Tracking Id</th>
                                                            <th>Date</th>
                                                            <th>Phone</th>
                                                            <th>Receiver</th>
                                                            <th>Destined Address</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dropOff as $dropOffs)
                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                <td>
                                                                    {{ $dropOffs->address1 ? 'PCu' : 'Drp' }}{{ date('mdy', strtotime($dropOffs->created_at)) }}{{ $dropOffs->id }}
                                                                </td>
                                                                <td>
                                                                    {{ $dropOffs->date }}
                                                                </td>
                                                                @can(!'isCustomer')
                                                                    <td>
                                                                        {{ $dropOffs->name }}
                                                                    </td>
                                                                @endcan
                                                                <td>
                                                                    {{ $dropOffs->phone }}
                                                                </td>
                                                                <td>
                                                                    {{ $dropOffs->toname }}
                                                                </td>
                                                                <td toggle="tootip"
                                                                    title="{{ $dropOffs->toaddress1 .
                                                                        ', ' .
                                                                        $dropOffs->toaddress2 .
                                                                        ', ' .
                                                                        $dropOffs->topostcode .
                                                                        ' ' .
                                                                        $dropOffs->tocity .
                                                                        ', ' .
                                                                        $dropOffs->toprovince .
                                                                        ', ' .
                                                                        $dropOffs->tocountry }}">
                                                                    {{ Str::limit(
                                                                        $dropOffs->toaddress1 .
                                                                            ', ' .
                                                                            $dropOffs->toaddress2 .
                                                                            ', ' .
                                                                            $dropOffs->topostcode .
                                                                            ' ' .
                                                                            $dropOffs->tocity .
                                                                            ', ' .
                                                                            $dropOffs->toprovince .
                                                                            ', ' .
                                                                            $dropOffs->tocountry,
                                                                        30,
                                                                    ) }}
                                                                </td>
                                                                <td>
                                                                    {{ $dropOffs->status ? $dropOffs->status : 'Unpaid' }}
                                                                </td>
                                                                <td>
                                                                    <a class="btn bg-purple" toggle="tooltip"
                                                                        title="Generate XML"
                                                                        href="dropXML/{{ $dropOffs->id }}">
                                                                        <i class="fa-solid fa-code text-white"></i>
                                                                    </a>
                                                                    @if ($dropOffs->status && $dropOffs->status != 'Unpaid')
                                                                        <a class="btn bg-orange" toggle="tooltip"
                                                                            title="Generate Invoice"
                                                                            href="invoiceDropOff/{{ $dropOffs->id }}">
                                                                            <i
                                                                                class="fa-solid fa-file-lines text-white"></i>
                                                                        </a>
                                                                        <a class="btn bg-dark" toggle="tooltip"
                                                                            title="Generate Consignment"
                                                                            href="DropConsignment/{{ $dropOffs->id }}">
                                                                            <i class="fa-solid fa-file-invoice"></i>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @if ($dropOff instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                                <div class="card-footer">
                                                    {{ $dropOff->links() }}
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="pickUp">
                                    <div class="post">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Pick Up</h3>
                                                <div class="card-tools">
                                                    <a href="PAXML" type="button" class="btn btn-tool bg-purple"
                                                        toggle="tooltip" title="Generate XML">
                                                        <i class="fa-solid fa-file-code text-white"></i>
                                                    </a>
                                                    <a href="pickCSV" type="button" class="btn btn-tool bg-green"
                                                        toggle="tooltip" title="Download CSV">
                                                        <i class="fa-solid fa-file-excel text-white"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Tracking Id</th>
                                                            <th>Date</th>
                                                            <th>Sender</th>
                                                            <th>Receiver</th>
                                                            <th>Origin Address</th>
                                                            <th>Destined Address</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pickUp as $pickUps)
                                                            <tr class="pointer">
                                                                <td>{{ $pickUps->address1 ? 'PCu' : 'Drp' }}{{ date('mdy', strtotime($pickUps->created_at)) }}{{ $pickUps->id }}
                                                                </td>
                                                                <td>{{ $pickUps->date }}</td>
                                                                <td>
                                                                    {{ $pickUps->name }}
                                                                </td>
                                                                <td>
                                                                    {{ $pickUps->toname }}
                                                                </td>
                                                                <td toggle="tootip"
                                                                    title="{{ $pickUps->address1 .
                                                                        ', ' .
                                                                        $pickUps->address2 .
                                                                        ', ' .
                                                                        $pickUps->postcode .
                                                                        ' ' .
                                                                        $pickUps->city .
                                                                        ', ' .
                                                                        $pickUps->province .
                                                                        ', ' .
                                                                        $pickUps->country }}">
                                                                    {{ Str::limit($pickUps->address1 . ', ' . $pickUps->address2 . ', ' . $pickUps->postcode . ', ' . $pickUps->city . ', ' . $pickUps->province . ', ' . $pickUps->country, 30) }}
                                                                </td>
                                                                <td toggle="tootip"
                                                                    title="{{ $pickUps->toaddress1 .
                                                                        ', ' .
                                                                        $pickUps->toaddress2 .
                                                                        ', ' .
                                                                        $pickUps->topostcode .
                                                                        ' ' .
                                                                        $pickUps->tocity .
                                                                        ', ' .
                                                                        $pickUps->toprovince .
                                                                        ', ' .
                                                                        $pickUps->tocountry }}">

                                                                    {{ Str::limit($pickUps->toaddress1 . ', ' . $pickUps->toaddress2 . ', ' . $pickUps->topostcode . ', ' . $pickUps->tocity . ', ' . $pickUps->toprovince . ', ' . $pickUps->tocountry, 30) }}
                                                                </td>
                                                                <td>
                                                                    {{ $pickUps->status ? $pickUps->status : 'Unpaid' }}
                                                                </td>
                                                                <td>
                                                                    <a class="btn bg-purple" toggle="tooltip"
                                                                        title="Generate XML"
                                                                        href="pickXML/{{ $pickUps->id }}">
                                                                        <i class="fa-solid fa-code white"></i>
                                                                    </a>
                                                                    @if ($pickUps->status && $pickUps->status != 'Unpaid')
                                                                        <a class="btn bg-orange" toggle="tooltip"
                                                                            title="Generate Receipt"
                                                                            href="invoicePickUP/{{ $pickUps->id }}">
                                                                            <i
                                                                                class="fa-solid fa-file-lines text-white"></i>
                                                                        </a>
                                                                        <a class="btn bg-dark" toggle="tooltip"
                                                                            title="Generate Consignment"
                                                                            href="PickConsignment/{{ $pickUps->id }}">
                                                                            <i class="fa-solid fa-file-invoice"></i>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @if ($pickUp instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                                <div class="card-footer">
                                                    {{ $pickUp->links() }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
