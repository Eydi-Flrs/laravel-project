<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KMS</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">



</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
            <div class="sidebar-brand-text mx-3"><img src="{{asset('/storage/images/profile/black.png')}}" height="50px" alt="">COS KMS</div>

        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.index')}}">
            <i class="fa fa-desktop fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.activityLog')}}">
            <i class="fa fa-pencil-square fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                <span>Activity Log</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <x-admin.sidebar.admin-sidebar-posts-links></x-admin.sidebar.admin-sidebar-posts-links>
        <x-admin.sidebar.admin-sidebar-categories-links></x-admin.sidebar.admin-sidebar-categories-links>
        <x-admin.sidebar.admin-sidebar-tags-links></x-admin.sidebar.admin-sidebar-tags-links>
        <x-admin.sidebar.admin-sidebar-users-links></x-admin.sidebar.admin-sidebar-users-links>
        <!-- Divider -->
        <x-admin.sidebar.admin-sidebar-archived-links></x-admin.sidebar.admin-sidebar-archived-links>

        <!-- Roles and permission -->
{{--        <hr class="sidebar-divider">--}}
{{--        <x-admin.sidebar.authorization-links></x-admin.sidebar.authorization-links>--}}




{{--        <!-- Sidebar Toggler (Sidebar) -->--}}
{{--        <div class="text-center d-none d-md-inline">--}}
{{--            <button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
{{--        </div>--}}

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                  <x-admin.top-nav.admin-top-navbar-user-information></x-admin.top-nav.admin-top-navbar-user-information>

                </ul>

            </nav>
            <!-- End of Topbar -->
            @if(Route::is('admin.index'))
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class=" mb-0 text-gray-800">Dashboard</h1>
                    <button class="btn btn-primary m-3" onclick="window.print()"><i class="fa fa-print fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i> Print</button>
            </div>
            </div>
            @endif
            @if(Route::is('post.qr'))
                <div class="container-fluid">
                    <button class="btn btn-primary m-3" onclick="window.print()">print qr codes</button>
                </div>

            @endif

            <style>
                @media print{
                    body *{
                        visibility: hidden;
                    }
                    .print-container, .print-container *{
                        visibility: visible;
                    }
                    .print-container{
                        position: absolute;
                        left: 0px;
                        top: 0px;
                    }
                }
            </style>
            <!-- Begin Page Content -->
            <div class="container-fluid print-container">

                <!-- Page Heading -->
               @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; TUP KMS 2022</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

@yield('scripts')
</body>

</html>
