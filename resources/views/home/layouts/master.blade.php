<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>WebProg - @yield('title')</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('home/img/favicon.png')}}" />

  <!-- CSS
	============================================ -->

  @vite(['resources/scss/home/home.scss'])
</head>

<body>
  <div class="wrapper">

   @include('home.commons.header')

   @include('home.commons.mobile_canvas')

   @yield('content')

   @include('home.commons.footer')


</div>

<!-- All JS is here
    ============================================ -->

    <script src="{{asset('home/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('home/js/plugins.js')}}"></script>

    @vite(['resources/js/home/app.js'])

    @yield('script')

    @stack('customjs')
</body>

</html>
