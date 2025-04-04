@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-blue-600 text-center mb-6">🩺 Login para Doctores</h2>
        
        <input type="email" placeholder="Correo electrónico" 
               class="w-full p-3 border rounded-lg mb-4 focus:ring focus:ring-blue-300">
        
        <input type="password" placeholder="Contraseña" 
               class="w-full p-3 border rounded-lg mb-4 focus:ring focus:ring-blue-300">
        
        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold">
            Iniciar Sesión
        </button>
    </div>
</div>
@endsection