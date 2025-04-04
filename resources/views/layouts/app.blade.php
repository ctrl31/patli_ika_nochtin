<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')

    </title>

  <!--css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">

 
    <!-- Aquí pueden ir tus enlaces a hojas de estilo -->
</head>
<body>
 
    @include('layouts.header')

  
      @yield('content')


    @include('layouts.footer')


  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>

</html>