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
        Schema::create('recordatorios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('numero_documento_trabajador');
            $table->string('nombre_trabajador');
            $table->string('clase_falta');
            $table->string('labor');
            $table->date('fecha_notificacion');
            $table->date('fecha_falta');
            $table->string('asunto');
            $table->text('descripcion_falta');
            $table->text('observaciones')->nullable();
            $table->string('quien_firma');
            $table->string('cargo_firmante');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recordatorios');
    }
};
