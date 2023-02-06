<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        C ONE STEEL SALES AND PRODUCTION
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
    <link href="{{ asset('demo/demo.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }} "></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="https:////cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    @livewireStyles
</head>

<body class="">
    <div class="wrapper ">

        <div class="sidebar" data-color="white" data-active-color="danger">
            {{-- @auth
                @if (auth()->user()->email_address === 'admin@admin')
                    <div class="text-center">
                        <div class="logo">
                            <div class="logo-image-small">
                                <img src="{{ asset('img/default-avatar.png') }}">
                            </div>
                            <!-- <p>CT</p> -->
                            ADMIN
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <div class="logo">
                            <div class="logo-image-small">
                                <img src="{{ asset('img/logo-small.png') }}">
                            </div>
                            <!-- <p>CT</p> -->
                            {{ auth()->user()->fullname() }}
                        </div>
                    </div>
                @endif
            @endauth --}}
            <div class="sidebar-wrapper">
                <ul class="nav">
                    @if (auth()->user()->username != 'admin')
                        <li @if (Route::currentRouteName() === 'dashboard') class="bg-primary" @endif>
                            <a href="{{ route('dashboard') }}">
                                <i class="nc-icon nc-app"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    @endif
                    <li @if (Route::currentRouteName() === 'branch') class="bg-primary" @endif>
                        <a href="{{ route('branch') }}">
                            <i class="nc-icon nc-istanbul"></i>
                            <p>Branches</p>
                        </a>
                    </li>
                    <li @if (Route::currentRouteName() === 'bankaccount') class="bg-primary" @endif>
                        <a href="{{ route('bankaccount') }}">
                            <i class="nc-icon nc-bank"></i>
                            <p>Bank Accounts</p>
                        </a>
                    </li>
                    <li @if (Route::currentRouteName() === 'user') class="bg-primary" @endif>
                        <a href="{{ route('user') }}">
                            <i class="nc-icon nc-circle-10"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li @if (Route::currentRouteName() === 'raw') class="bg-primary" @endif>
                        <a href="{{ route('raw') }}">
                            <i class="nc-icon nc-ruler-pencil"></i>
                            <p>Raw Materials</p>
                        </a>
                    </li>
                    <li @if (Route::currentRouteName() === 'product') class="bg-primary" @endif>
                        <a href="{{ route('product') }}">
                            <i class="nc-icon nc-settings"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li @if (Route::currentRouteName() === 'variation') class="bg-primary" @endif>
                        <a href="{{ route('variation') }}">
                            <i class="nc-icon nc-refresh-69"></i>
                            <p>Product Variation</p>
                        </a>
                    </li>
                    <li @if (Route::currentRouteName() === 'price') class="bg-primary" @endif>
                        <a href="{{ route('price') }}">
                            <i class="nc-icon nc-money-coins"></i>
                            <p>Product Prices</p>
                        </a>
                    </li>
                    <li @if (Route::currentRouteName() === 'customer') class="bg-primary" @endif>
                        <a href="{{ route('customer') }}">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Customers</p>
                        </a>
                    </li>
                    <li @if (Route::currentRouteName() === 'jomachine') class="bg-primary" @endif>
                        <a href="{{ route('jomachine') }}">
                            <i class="nc-icon nc-cart-simple"></i>
                            <p>Production</p>
                        </a>
                    </li>
                    {{-- <li @if (Route::currentRouteName() === 'inquiries') class="bg-primary" @endif>
                        <a href="{{ route('inquiries') }}">
                            <i class="nc-icon nc-alert-circle-i"></i>
                            <p>Inquiries</p>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                    </div>
                    <a href="{{ route('home') }}">
                        <h6>C ONE STEEL SALES AND PRODUCTION</h6>
                    </a>
                    {{-- 
                    <div class="ml-5 pl-5">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <li>{!! \Session::get('success') !!}</li>
                            </div>
                        @endif
                        @if (\Session::has('status'))
                            <div class="alert alert-danger">
                                <li>{!! \Session::get('status') !!}</li>
                            </div>
                        @endif
                    </div> --}}

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        @auth
                            <ul class="navbar-nav">
                                {{-- <li class="nav-item">
                                    <a class="nav-link btn-rotate btn btn-primary" data-toggle="modal"
                                        data-target="#profile">
                                        <i class="nc-icon nc-settings-gear-65"></i>
                                        <p>
                                            <span class="d-lg-none d-md-block"></span>{{ auth()->user()->email_address }}
                                        </p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link btn-rotate btn btn-danger" href="{{ route('logout') }}">
                                        <p>
                                            <span class="d-lg-none d-md-block"></span>LOGOUT
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        @endauth

                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                @yield('content')
            </div>
            {{-- @guest
                <div wire:ignore.self class="modal fade" id="log" tabindex="-1" role="dialog" aria-labelledby="log"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="log">LOGIN</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="{{ route('login') }}">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p for="">Email: </p>
                                            <p for="">Password: </p>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" name="email_address" class="form-control mb-2"
                                                required>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">LOGIN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest --}}

            {{-- @auth
                <div wire:ignore.self class="modal fade" id="profile" tabindex="-1" role="dialog"
                    aria-labelledby="log" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="log">LOGIN</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="{{ route('profile') }}">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p for="">First Name: </p>
                                            <p for="">Last Name: </p>
                                            <a class="btn btn-danger" data-toggle="collapse"
                                                href="#multiCollapseExample1" role="button" aria-expanded="false"
                                                aria-controls="multiCollapseExample1">CHANGE PASSWORD</a>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="first_name" class="form-control mb-2" required
                                                value="{{ auth()->user()->first_name }}">
                                            <input type="text" name="last_name" class="form-control mb-2" required
                                                value="{{ auth()->user()->last_name }}">
                                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                <div class="card card-body">
                                                    <label for="">New Password: </label>
                                                    <input type="password" placeholder="New Password" name="password"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">UPDATE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth --}}
        </div>
    </div>
    @livewireScripts
</body>

</html>
