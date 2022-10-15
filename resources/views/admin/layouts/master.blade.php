<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Vendor CSS-->
    <link href="{{asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        <li>
                            <a href="{{route('category#list')}}" class="text-decoration-none">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li>
                        <li>
                            <a href="{{route('product#list')}}" class="text-decoration-none">
                                <i class="fas fa-pizza-slice"></i>Products</a>
                        </li>
                        <li>
                            <a href="{{route('admin#orderList')}}" class="text-decoration-none">
                                <i class="fas fa-chart-bar"></i>Order List</a>
                        </li>
                        <li>
                            <a href="{{route('admin#userList')}}" class="text-decoration-none">
                                <i class="fas fa-users"></i>User List</a>
                        </li>


                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <h4>Admin Dashboard Panel</h4>
                                {{-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button> --}}
                            </form>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        @if (Auth::user()->image==null)
                                        @if (Auth::user()->gender == 'male')
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="{{asset('image/default_image_male.png')}}" alt="{{Auth::user()->name}}" />
                                                            </a>
                                                        </div>
                                                        @else
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="{{asset('image/default_image_female.png')}}" alt="{{Auth::user()->name}}" />
                                                            </a>
                                                        </div>
                                                    @endif
                                        @else
                                        <div class="image">
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}" />
                                        </div>
                                        @endif
                                        <div class="content">
                                            <a class="js-acc-btn text-decoration-none" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                @if (Auth::user()->image == null)
                                                    @if (Auth::user()->gender == 'male')
                                                        <div class="image">
                                                            <a href="#" >
                                                                <img src="{{asset('image/default_image_male.png')}}" alt="{{Auth::user()->name}}" />
                                                            </a>
                                                        </div>
                                                        @else
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="{{asset('image/default_image_female.png')}}" alt="{{Auth::user()->name}}" />
                                                            </a>
                                                        </div>
                                                    @endif
                                                @else
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{asset('storage/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}" />
                                                    </a>
                                                </div>
                                                @endif
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#" class="text-decoration-none">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#details')}}" class="text-decoration-none">
                                                        <i class="fa fa-user"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#list')}}" class="text-decoration-none">
                                                        <i class="fa-solid fa-users"></i>Admin Group</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#changePasswordPage')}}" class="text-decoration-none">
                                                        <i class="fa fa-key"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="">
                                                    <form action="{{route('logout')}}" method="post" class="">
                                                        @csrf
                                                        <button class="" type="submit">
                                                            <i class="fa fa-right-from-bracket"></i>
                                                            Logout
                                                        </button>
                                                    </form>
                                                </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

        <div class="page-container">
            @yield('content')

        </div>

    </div>

    <!-- Jquery JS-->
    {{-- <script src="{{asset('admin/vendor/jquery-3.2.1.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JS-->
    {{-- <script src="{{asset('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script> --}}
    <!-- Vendor JS       -->
    <script src="{{asset('admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/vendor/select2/select2.min.js')}}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Main JS-->
    <script src="{{asset('admin/js/main.js')}}"></script>

</body>
@yield('scriptSection')

</html>
<!-- end document-->
