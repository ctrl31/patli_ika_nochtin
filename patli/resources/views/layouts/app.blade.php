<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')

    </title>

  <!--css -->
  <link rel="stylesheet" href="{{asset('public/css/style.css')  }}">
  <link rel="stylesheet" href="{{asset('public/css/bootsrap.min.css')  }}">
 
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