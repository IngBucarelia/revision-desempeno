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
        Schema::create('novedades_contrato', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_reporte')->nullable();
            $table->enum('tipo_novedad', ['D', 'R', 'C']); // D = Desvinculación, R = Renovación, C = Cambio de contrato
            $table->string('nombre_trabajador');
            $table->string('codigo_trabajador');
            $table->date('fecha_novedad')->nullable();
            $table->string('tiempo_prorroga')->nullable(); // Solo para R
            $table->string('tipo_contrato')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('diligenciado_por')->nullable();
            $table->string('autorizado_por')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novedades_contrato');
    }
};
