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
        Schema::create('movimientos_novedades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proceso_id'); // ID del registro (novedad o revision)
            $table->string('modulo'); // 'novedad_contrato' o 'revision_desempeno'
            $table->string('codigo_proceso')->nullable(); // opcional, por si hay un código
            $table->unsignedBigInteger('usuario_id');
            $table->string('accion'); // 'Creado', 'Editado', etc.
            $table->timestamp('fecha_hora');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos_procesos');
    }
};
