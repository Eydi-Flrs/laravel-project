<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TUP KMS</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/blog-home.css')}}" rel="stylesheet">


</head>

<body >

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">KNOWLEDGE MANAGEMENT SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                @if(auth()->user()->userHasRole('Admin'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.index')}}">Admin</a>
                </li>
                @endif
                @if(Auth::check())
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                            <img class="img-profile rounded-circle" src=" ">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{route('user.profile.show',auth()->user())}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{route('favorite.index',auth()->user())}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Saved
                            </a>
                            <div class="dropdown-divider"></div>
                            <div class="d-flex justify-content-center">
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout</button>
                                </form>
                            </div>


                        </div>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                @endif

                <li class="nav-item">
                    <form  method="get" action="{{route('search.all')}} "class="row">
                        @csrf
                        <div class="col-md-9">
                            <input class="form-control mr-sm-2" type="search" name="topNavSearch" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </div>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->

<div class="container">

    @yield('profile')

    <div class="row">
        @yield('search')
    </div>

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

           @yield('content')

        </div>
    @yield('pdfview')

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Categories Widget -->

            @yield('categories_widget')
            @yield('year')
            @yield('tags')
            @yield('top-views')


        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; TUP KMS 2022</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">


{{--<script>--}}
{{--    $(document).ready(function (){--}}
{{--        $('#search').on('keyup',function(){--}}
{{--          var query=$(this).val();--}}
{{--          $.ajax({--}}
{{--              url:"search",--}}
{{--              type:"GET",--}}
{{--              data:{'search':query},--}}
{{--              success:function(data){--}}
{{--                $('#search_list').html(data);--}}
{{--              }--}}
{{--          });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}


</body>

</html>
