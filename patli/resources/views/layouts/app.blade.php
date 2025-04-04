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


    <!-- Contenido principal -->
     @yield('content')


     @include('layouts.footer')



    <!-- Scripts comunes -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Espacio para scripts específicos de vistas -->
    @stack('scripts')
</body>
</html>