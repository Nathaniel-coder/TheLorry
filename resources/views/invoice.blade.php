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
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/home" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="rateXML" role="button" toggle="tooltip" title="Rates">
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
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
                            <li class="nav-item">
                                <a href="/home" class="nav-link">
                                    <i class="fa-solid fa-gauge-high nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
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
                            <h1>Receipt</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content" style="@media print{color: black}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="invoice">
                                <div class="blue-tag">
                                    <div class="text-center pt-1">
                                        <label>R</label>
                                        <label>E</label>
                                        <label>C</label>
                                        <label>E</label>
                                        <label>I</label>
                                        <label>P</label>
                                        <label>T</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">

                                    </div>
                                    <div class="col-5">
                                        <h1 class="document-type display-4"><span>TheLorry</span></h1>
                                        <p class="text-right"><strong>Ref. Code
                                                <em>{{ $data->address1 ? 'P' : 'D' }}{{ date('Ymmd', strtotime($data->created_at)) }}-{{ Auth::user()->id }}</em></strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9">
                                        <br><br><br><br>
                                        <hr>
                                        <p>
                                            <strong></strong><br>
                                            Tracking Code:
                                            <em>
                                                {{ $data->address1 ? 'PCu' : 'Drp' }}{{ date('mdy', strtotime($data->created_at)) }}{{ $data->id }}
                                            </em>
                                            <br>
                                            {{ $data->phone }}
                                            <br>
                                            {{ date('d M Y', strtotime($data->date)) }}
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <p class="text-right">
                                            <strong>The Lorry Sdn.Bhd.</strong><br>
                                            Address<br>
                                            Address
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Weight</th>
                                            <th>Height</th>
                                            <th>Width</th>
                                            <th>length</th>
                                            <th>Total (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $data->address1 ? 'Drop Off' : 'Pick Up' }}</td>
                                            <td>{{ $data->weight ? $data->weight : 'undefined' }}</td>
                                            <td>{{ $data->height ? $data->height : 'undefined' }}</td>
                                            <td>{{ $data->width ? $data->weight : 'undefined' }}</td>
                                            <td>{{ $data->length ? $data->weight : 'undefined' }}</td>
                                            <td class="text-right">{{ $data->price ? $data->weight*3 : 'undefined' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-8">
                                    </div>
                                    <div class="col-4">
                                        <table class="table table-sm text-right">
                                            <tr>
                                                <td><strong>Total HT</strong></td>
                                                <td class="text-right">
                                                    {{ $data->price ? $data->weight * 2.7 : 'undefined' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Transportation Fees</td>
                                                <td class="text-right">
                                                    {{ $data->price ? $data->weight * 0.03    : 'undefined' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Service Fees</td>
                                                <td class="text-right">
                                                    {{ $data->price ? $data->weight * 0.08 : 'undefined' }}</td>
                                            </tr>
                                            tr>
                                                <td>GST</td>
                                                <td class="text-right">
                                                    {{ $data->price ? $data->weight * 0.06 : 'undefined' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="blue-tag">
                                    <div class="text-center pt-1">
                                        <label>R</label>
                                        <label>E</label>
                                        <label>C</label>
                                        <label>E</label>
                                        <label>I</label>
                                        <label>P</label>
                                        <label>T</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
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
