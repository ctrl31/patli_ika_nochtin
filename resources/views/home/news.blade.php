

<!-- Contenedor principal -->
<div class="container py-5">
  <div class="text-center mb-4">
    <h1 class="health_taital">Comenzemos cuentanos...</h1>
   
  </div>
  
  <!-- Fila de botones -->
  <div class="row justify-content-center">
    <!-- Botón 1 -->
    <div class="col-md-5 col-sm-12 mb-4">
      <a href="{{ route('loginDoctor') }}" class="custom-btn">
        <img src="{{ asset('images/icon-2.png') }}" alt="Daily care experts" class="img-fluid">
        <h4 class="mb-0">Eres un Doctor?</h4>
      </a>
    </div>
    
    <!-- Botón 2 -->
    <div class="col-md-5 col-sm-12 mb-4">
      <a href="{{ route('loginPaciente') }}" class="custom-btn">
        <img src="{{ asset('images/icon-4.png') }}" alt="Balanced care" class="img-fluid">
        <h4 class="mb-0">Eres un Paciente?</h4>
      </a>
    </div>
  </div>
</div>
