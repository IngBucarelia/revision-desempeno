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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->date('fecha_ingreso');
            $table->boolean('periodo_prueba')->default(false);
            $table->unsignedBigInteger('id_cia')->nullable();
            $table->unsignedBigInteger('id_cargo');
            $table->unsignedBigInteger('id_co')->nullable();
            $table->unsignedBigInteger('id_tipo_cotizante')->nullable();
            $table->unsignedBigInteger('id_ccosto')->nullable();
            $table->unsignedBigInteger('id_centro_trabajo')->nullable();
            $table->unsignedBigInteger('id_tipo_nomina')->nullable();
            $table->string('numero_contrato')->nullable();
            $table->string('correo')->unique();
            $table->string('telefono');
            $table->string('estado_civil');
            $table->timestamps();
    
            // Claves foráneas (opcional, si existen las tablas referenciadas)
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
