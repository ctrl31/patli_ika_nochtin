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


  <!-- Chatbase Chatbot -->
 
    <!-- Aquí pueden ir tus enlaces a hojas de estilo -->
</head>
<script>
  window.chatbaseConfig = {
    chatbotId: "7HR2jYXSIferoOW35oKAT",
  };
</script>
<script src="https://www.chatbase.co/embed.min.js" defer></script>
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