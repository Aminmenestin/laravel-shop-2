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

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.czMore-latest.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

    @include('admin.commons.logout-modal')


    @vite(['resources/js/admin/app.js'])

    @yield('script')

    @include('sweetalert::alert')


</body>

</html>
