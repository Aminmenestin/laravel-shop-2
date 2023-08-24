<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Shop.ir  @yield('title')</title>


    <!-- Custom styles for this template-->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    @vite(['resources/scss/admin/admin.scss'])

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.commons.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.commons.topbar')

                @yield('content')

            </div>
            <!-- End of Main Content -->

            @include('admin.commons.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    @include('admin.commons.logout-modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    @vite(['resources/js/admin/app.js'])

    <script type="module" src="{{asset('admin/js/jquery.czMore-latest.js')}}"></script>
    <script type="module" src="{{asset('admin/js/sb-admin-2.js')}}"></script>
    <script type="module" src="{{asset('admin/js/chart-area-demo.js')}}"></script>
    <script type="module" src="{{asset('admin/js/chart-pie-demo.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

    @yield('script')

    @include('sweetalert::alert')


</body>

</html>
