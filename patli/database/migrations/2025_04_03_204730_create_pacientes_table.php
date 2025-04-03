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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id(); // Id autoincremental
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('email');
            $table->date('fecha_nacimiento');
            $table->string('curp')->nullable();
            $table->string('nss')->nullable();
            $table->string('tipo_padecimiento')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('sexo');
            $table->boolean('discapacidad')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->string('password');
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at para soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
