<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensajeria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPaciente')->constrained('pacientes');
            $table->foreignId('idDoctor')->constrained('doctors');
            $table->text('mensaje');
            $table->string('estatusMensaje')->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajeria');
    }
};
